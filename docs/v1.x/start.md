### Deal with it
In order to start using NovaGram, you just need to create the class
```php
$Bot = new \Telegram\Bot("YOUR_TOKEN");
```

### Example
An example code of a simple bot that just forwards back what you send.

```php
require __DIR__ . '/vendor/autoload.php';

$Bot = new skrtdev\NovaGram\Bot("YOUR_TOKEN", [
    "json_payload" => true
]);

$update = $Bot->update;
$message = $update->message;
$chat = $message->chat;
$user = $message->from;

$message->forward([], true); // forward() with no parameters will forward the Message back to the sender
```

Using `"json_payload" => true` and `true` in forward method, the api call will be print as payload, making the bot faster. Only one Api Call can use json payload

More info in the [Documentation](docs.md)
