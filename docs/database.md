# Database

NovaGram has a built-in Database, (from v1.3), that allows you to store some useful infos without having care of writing boring boilerplate code.

## Connecting to Database

`database` key of settings array is structured as follows:

```php
[
    "driver" => $driver, // default to mysql
    "host" => $host, // default to localhost:3306
    "dbname" => $dbname,
    "dbuser" => $dbuser,
    "dbpass" => $dbpass, // default to an empty string
    "prefix" => $prefix // default to "novagram"
]
```

`driver`, `host`, `dbname`, `dbuser` and `dbpass` are Database connection variables, while `prefix` is table names prefix

## Statuses & Conversations

Conversations are **chat-related** variables (a chat can also be an _User_).

Here is the function:

```php
public function conversation(string $name, $value = null, bool $permanent = true)
```

Let's do an example: you want to store an User birthplace, so that can be retrieved later

```php
$user->conversation("birthplace", "New York");
```

That's all, birthplace is now stored in Database, and it can be retrieved later with

```php
$user->conversation("birthplace");
```

Statuses are just Conversations whose key is ```status```, except that ```$permanent``` is default to false:
```php
public function status(string $value = null, bool $permanent = false)
```

Statuses are useful when you need to store some **temporary** data, and can be used together with conversations

```php
$user_status = $user->status();

if($message->text === "/setbirthplace"){
    $message->reply("Your birthplace is:");
    $user->status("setbirthplace");
}
elseif($message->text === "/mybirthplace"){
    $birthplace = $user->conversation("birthplace");
    if(isset($birthplace)){
        $message->reply("Your birthplace is $birthplace.");
    }
    else{
        $message->reply("You didn't set a birthplace yet.\nSet it with /setbirthplace");
    }
}
elseif(isset($user_status)){

    if($user_status === "setbirthplace"){
        $user->conversation("birthplace", $message->text);
        $message->reply("What a nice place!");
    }

}
```
