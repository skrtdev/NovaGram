# NovaGram Objects

In NovaGram, each Telegram Object is an Instance of a single Class, called TelegramObject.

Using one single Class for all the Objects makes more easier to develop an Object Oriented Framework.

Since there is just one Class, all the Object Methods are defined in a json file, making very easy creating personal Methods.

## Update Object

If you haven't disabled webhook, you can find the just received Update object in `$Bot->update`.

I recommend to use Objects Method `has` (that is just a shortcut of `property_exists`) to check what the update is.

```php
$update = $Bot->update; // this is the update received from the bot

if($update->has("message")){ // update is a message

    $message = $update->message;
    $chat = $message->chat;
    $user = $message->from;

    if($message->has("text")){ // update message contains text

        // code...

    }
    else { // Message doesn't contain text

        // code...

    }

}

if($update->has("callback_query")){ // update is a callback query

    $callback_query = $update->callback_query;
    $user = $callback_query->from;

    $message = $callback_query->message;
    $chat = $message->chat;

    // code...

}
```

## Objects Methods

In NovaGram, you can use _Object Methods_, that are a smarter way to use Methods.

An immediate example:

Normal Method:
```php
$Bot->sendMessage([
    "chat_id" => 01234567,
    "text" => "This is the text of a Message"
]);
```
Object Method:
```php
$chat->sendMessage("This is the text of a Message");
```

Using the Object Method is surely easier and faster, and it makes code well-readable.
