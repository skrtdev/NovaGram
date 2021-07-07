# Database

NovaGram has a built-in Database that allows you to store some useful infos without having care of writing boring boilerplate code.

## Connecting to Database

`database` key of settings array must be an instance of `skrdtev\NovaGram\Database\DatabaseInterface`.  
There are some ready-to-use classes for some of the most used databases:

```php
use skrtdev\NovaGram\Bot;
use skrtdev\NovaGram\Database\{PostgreSQLDatabase, MySQLDatabase, SQLiteDatabase};

$db = new MySQLDatabase('localhost:3306', 'dbname', 'username', 'password (not required)', 'novagram (table names prefix)');
$db = new PostgreSQLDatabase('localhost:5432', 'dbname', 'username', 'password (not required)', 'novagram');
$db = new SQLiteDatabase('db.sqlite3', 'novagram');

$Bot = new Bot('TOKEN', database: $db);
```

# Some tricks  

Database classes, when instantiated, make some queries to create tables needed by the library.  
This is useful only the first time, so you can disable it by passing `false` to the last parameter of class constructor.

```php
$db = new MySQLDatabase('localhost:3306', 'dbname', 'username', '', 'novagram', false);
$db = new PostgreSQLDatabase('localhost:5432', 'dbname', 'username', create_tables: false);
$db = new SQLiteDatabase('db.sqlite3', 'novagram', false);
```

It will increase performances especially on webhook, as it won't even connect to database if not required.

## Statuses & Conversations

Conversations are **chat-related** variables (a chat can also be an _User_).

Here is the function:

```php
public function conversation(string $name, $value = null, bool $permanent = true)
```

Let's do an example: you want to store an User birthplace, so that can be retrieved later

```php
$user->conversation('birthplace', 'New York');
```

That's all, birthplace is now stored in Database, and it can be retrieved later with

```php
$user->conversation('birthplace');
```

### Statuses

Statuses are just Conversations whose key is ```status```, except that ```$permanent``` is default to false:
```php
public function status(string $value = null, bool $permanent = false)
```

Statuses are useful when you need to store some **temporary** data, and can be used together with conversations

```php
use skrtdev\Telegram\Message;

$Bot->onCommand('setbirthplace', function(Message $message){
    $user = $message->from;
    $message->reply('Your birthplace is:');
    $user->status('setbirthplace');
    stop_handling();
});

$Bot->onCommand('mybirthplace', function(Message $message){
    $user = $message->from;
    $birthplace = $user->conversation('birthplace');
    if(isset($birthplace)){
        $message->reply("Your birthplace is $birthplace.");
    }
    else{
        $message->reply('You didn\'t set a birthplace yet. Set it with /setbirthplace');
    }
    stop_handling();
});

$Bot->onTextMessage(function (Message $message){
    $user = $message->from;
    if($user->status() === 'setbirthplace'){
        $user->conversation('birthplace', $message->text);
        $message->reply('What a nice place!');
    }
});
```

# Extending

Do you want to customize database behaviour? You're in the right place.
Let's assume that you're using an sqlite database, and you want to save users' usernames in database (NovaGram by default saves only id).

```php
use skrtdev\NovaGram\Database\SQLiteDatabase;
use skrtdev\NovaGram\Bot;
use skrtdev\Telegram\User;

class CustomSQLiteDatabase extends SQLiteDatabase
{
    protected static array $create_tables = [
        'CREATE TABLE IF NOT EXISTS {users_table} (
            user_id BIGINT(64) UNIQUE,
            username VARCHAR(64) NULL
        )',
        'CREATE TABLE IF NOT EXISTS {conversations_table} (
            chat_id BIGINT(64) NOT NULL,
            name VARCHAR(64) NOT NULL,
            value BLOB(4096) NOT NULL,
            is_permanent BOOL DEFAULT TRUE
        )'
    ];

    public function saveUser(User $user): void 
    {
        $this->query("INSERT INTO {$this->table_names['users']}(user_id, username) VALUES (:user_id, :username)", [
            ':user_id' => $user->id,
            ':username' => $user->username ?? null,
        ]);
    }
}

$Bot = new Bot('TOKEN', database: new CustomSQLiteDatabase('db.sqlite3'));
```

`$create_tables` is now updated with the new `username` column, which has also been added to `saveUser` method