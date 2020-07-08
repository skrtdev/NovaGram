# NovaGram (v0.4)
[![GitHub license](https://img.shields.io/github/license/skrtdev/NovaGram)](https://github.com/skrtdev/NovaGram/blob/master/LICENSE) [![GitHub stars](https://img.shields.io/github/stars/skrtdev/NovaGram)](https://github.com/skrtdev/NovaGram/stargazers) [![Version](https://img.shields.io/badge/version-0.4-blue)](https://github.com/skrtdev/NovaGram/releases)




An elegant, Object-Oriented, reliable PHP Telegram Bot Interface

### Installation via Composer
`composer require skrtdev/novagram`

### Deal with it
In order to start using NovaGram, you just need to create the class
```php
$Bot = new TelegramBot("YOUR_TOKEN");
```

### Example
An example code of a simple bot that just forwards back what you send.

```php
header('Content-Type: application/json');
require __DIR__ . '/vendor/autoload.php';

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
