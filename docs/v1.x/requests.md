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
$Bot->sendMessage(01234567, "message_text"); // from v1.4
```  
This will send a Message in the specified chat with the specified text.  

## Named and positional arguments

From v1.4, you can use methods in a different way.  
Instead of putting all parameters in the array, you can pass required parameters as positional arguments in the same order as they are in Bot Api Documentation.  
If you need to specify additional optional parameters, just put them in an array (as old mode) an pass it after required parameters.  
```php
$Bot->$method(...$required_parameters, array $optional_parameters = [], bool $payload = false);
```
```php
$Bot->sendMessage($chat_id, $text, array $optional_parameters = [], bool $payload = false);
```  
Example:
```php
$Bot->sendMessage([
    "chat_id" => 01234567,
    "text" => "message_text",
    "disable_notification" => true
]);
// same as
$Bot->sendMessage(01234567, "message_text", [
    "disable_notification" => true
]); // from v1.4
```  

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

[NovaGram Objects](construct.md)
