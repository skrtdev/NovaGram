# Errors Handling

In order to avoid a `try/catch` block in every handler, NovaGram offers you error handlers.
You can set an handler for every error of a specific kind, or just one handler for all the errors.
You can specify the type of the errors handled by the handler directly in the Closure type hinting.

```php
$Bot->addErrorHandler(function ($e) {
    print('Caught '.get_class($e).' exception from general handler'.PHP_EOL);
    print($e.PHP_EOL);
});
// is the same as
$Bot->addErrorHandler(function (Throwable $e) {
    print('Caught '.get_class($e).' exception from general handler'.PHP_EOL);
    print($e.PHP_EOL);
});
```

If you wanna an handler for a specific exception, just write it.

```php
$Bot->addErrorHandler(function (skrtdev\Telegram\Exception $e) {
    print('Caught '.get_class($e).' exception from speficic handler'.PHP_EOL);
});
```

The same exception can be caught by more than one handler, if the type corresponds.  
In this example, a `skrtdev\Telegram\Exception` is handled by both the `Throwable` and `skrtdev\Telegram\Exception` handlers.

If you don't set an Error Handler, the errors will be printed if you're using by CLI, or thrown if you're using Webhook.

## Settings debug

The settings debug parameter just creates this error handler:  
```php
$Bot->addErrorHandler(function (Throwable $e) use ($Bot) {
    $Bot->debug( (string) $e );
});
```

## Telegram Exceptions

Telegram Exceptions thrown by NovaGram are `skrtdev\Telegram\Exceptions`, but sometimes they are more speficic Exceptions that extend the main one, according to `error_code` number. Here's the full list:  

- `BadRequestException` (400)
- `UnauthorizedException` (401)
- `ForbiddenException` (403)
- `NotFoundException` (404)
- `MethodNotAllowedException` (405)
- `ConflictException` (409)
- `RequestEntityTooLargeException` (413) (probably thrown only when sending files/video/photos etc.)  
- `TooManyRequestsException` (429)
- `BadGatewayException` (502) (yes, sometimes it happens)

These can be treated like the main one.
