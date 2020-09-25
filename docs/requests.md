# Make requests

```php
$Bot->APICall(string $method, array $data, bool $payload = false, bool $is_debug = false);
```
Short syntax:
```php
$Bot->$method(array $data, bool $payload = false, bool $is_debug = false);
```

A simple example:

```php
$Bot->sendMessage([
    "chat_id" => 01234567,
    "text" => "message_text"
]);
// same as
$Bot->sendMessage(01234567, "message_text");
```

This will send a Message in the specified chat with the specified text.

### JSON Payload

If JSON Payload is enabled in Bot's settings, you can make a Payload request.
When making an API Call, pass `true` in `$payload` (or leave default), and it will be made as payload.

**NOTE: Attempt to use payload multiple times will result in a `Trying to use JSON Payload more than one time` Notice**

> Payload API Calls will be executed when script execution finishes

```php
$Bot->sendMessage(01234567, "This is a JSON Payload", true);
```

Argument `$payload` is `true`, so this will be made as Payload (if a Payload wasn't made yet).

## Exceptions

If NovaGram receives an error from Telegram, a `\skrdtev\Telegram\Exception` is raised (if Exceptions are not disabled in NovaGram settings)
`\skrdtev\Telegram\Exception(s)` can be handled like normal Exceptions, with a try/catch block

[NovaGram Objects](construct.md)
