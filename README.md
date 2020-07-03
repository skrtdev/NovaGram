# NovaGram
An elegant, Object-Oriented, reliable PHP Telegram Bot Interface

### Installation via PHPEasyGit
```php
require "../PHPEasyGit/autoload.php";
```

### Deal with it
In order to start using NovaGram, you just need to create the class
```php
$Bot = new TelegramBot("YOUR_TOKEN");
```

### Example
An example code of a simple bot that just forwards back what you send.

```php
header('Content-Type: application/json');
require "../PHPEasyGit/autoload.php";

$Bot = new TelegramBot("YOUR_TOKEN", [
    "json_payload" => true
]);
$update = $Bot->update;
$message = $update->message;
$chat = $message->chat;
$user = $message->from;

$update->message->forward([], true); // forward() with no parameters will forward the Message back to the sender
```

Using `"json_payload" => true` and `true` in forward method, the api call will be print as payload, making the bot faster. Only one Api Call can use json payload

More info in the [Documentation](https://docs.novagram.ga)
