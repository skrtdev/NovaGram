# NovaGram Objects

In NovaGram, each Telegram Object is an Instance of the `skrtdev\Telegram\Type` class, extended according to Object Type.

Since there is just one Class, all the Object Methods are defined in a json file, making very easy creating personal Methods.

## Update Object

If you haven't disabled webhook, you can find the just received Update object in `$Bot->update`.

You can use this variable, or you can use the new feature: handlers.
**NOTE**: Using `handlers`, the same code will work with both `getUpdates` and `Webhook`

### Examples

Using `$update`:  
```php
$update = $Bot->update; // this is the update received from the bot

if(isset($update->message)){ // update is a message

    $message = $update->message;
    $chat = $message->chat;
    $user = $message->from;

    if(isset($message->text)){ // update message contains text

        // code...

    }
    else { // Message doesn't contain text

        // code...

    }

}

if(isset($update->callback_query)){ // update is a callback query

    $callback_query = $update->callback_query;
    $user = $callback_query->from;

    $message = $callback_query->message;
    $chat = $message->chat;

    // code...

}
```

Using handlers:  
```php
$Bot->onMessage(function ($message) { // update is a message
    $chat = $message->chat;
    $user = $message->from;

    if(isset($message->text)){ // update message contains text

        // code...

    }
    else { // Message doesn't contain text

        // code...

    }
});

$Bot->onCallbackQuery(function ($callback_query) { // update is a callback query
    $user = $callback_query->from;

    $message = $callback_query->message;
    $chat = $message->chat;

    // code...
});
```

## Objects Methods

In NovaGram, you can use _Object Methods_, that are a smarter way to use Methods.

An immediate example:

Normal Method:
```php
$Bot->sendMessage($chat->id, "This is the text of a Message", [
    "reply_to_message_id" => $message->id
]);
// or
$chat->sendMessage("This is the text of a Message", [
    "reply_to_message_id" => $message->id
]);
```
Object Method:
```php
$message->reply("This is the text of a Message");
```

Using the Object Method is surely easier and faster, and it makes code well-readable.

## Named and positional arguments

From v1.5, you can use object methods in a different way.  
Instead of putting all parameters in the array, you can pass required parameter as positional argument.
If you need to specify additional optional parameters, just put them in an array (as old mode) an pass it after required parameter.  
```php
public function $method($required_parameter, array $optional_parameters = [], bool $payload = false);
```
```php
$message->reply($text, array $optional_parameters = [], bool $payload = false);
```  
Example:
```php
$message->reply([
    "text" => "message_text",
    "disable_notification" => true
]);
// same as
$message->reply("message_text", [
    "disable_notification" => true
]); // from v1.5
```  

## Debugging

When debugging, you can use two methods:
```php
$Bot->debug($value);
```
is the same as
```php
$Bot->sendMessage([
    "chat_id" => $Bot->settings->debug,
    "text" => "<pre>".htmlspecialchars( is_string($value) ? $value : Utils::var_dump($value) )."</pre>",
    "parse_mode" => "HTML"
]);
```
while
```php
$message->debug(); // $message can be any Telegram Type
```
is the same as
```php
$Bot->debug($message);
```
