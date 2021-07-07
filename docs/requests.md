# Make requests

```php
$Bot->APICall(string $method, array $data = [], ?string $class_name = null, bool $payload = false, bool $is_debug = false);
```
Short syntax:
```php
$Bot->methodName(array $data, bool $payload = false);
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
$Bot->methodName(...$required_parameters, array $optional_parameters = [], bool $payload = false);
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

#### PHP8

From v1.8, you can pass arguments as [named arguments](https://www.php.net/manual/en/functions.arguments.php#functions.named-arguments).
```php
$Bot->sendMessage(01234567, 'Hello', disable_notification: true, parse_mode: 'HTML');
```  

### JSON Payload

If JSON Payload is enabled in Bot's settings, you can make a Payload request.
When making an API Call, pass `true` in `$payload` (or leave default), and it will be made as payload.

**NOTE: Attempt to use payload multiple times will silently make requests in normal way**

> Payload API Calls will be executed when script execution finishes

```php
$Bot->sendMessage(01234567, 'This is a JSON Payload', true);
```

Argument `$payload` is `true`, so this will be made as payload (if a payload wasn't made yet).

## Exceptions

If NovaGram receives an error from Telegram, a [`\skrdtev\Telegram\Exception`](errors_handling.md) is raised (if Exceptions are not disabled in NovaGram settings)  

[NovaGram Objects](construct.md)
