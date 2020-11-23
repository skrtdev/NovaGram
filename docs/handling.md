# Updates Handling

In order to handle different kinds of updates, you can put all your in code in the `onUpdate` handler, or split it across different handlers (e.g. `onMessage`, `onCallbackQuery`)

```php
$Bot->onUpdate(function (Update $update) use ($Bot) {
    if(isset($update->message)){
        $message = $update->message;
        $message->reply("WHAT? A Message?!?");
    }
});
```

```php
$Bot->onMessage(function (Message $message) use ($Bot) {
    $message->reply("WHAT? A Message?!?");
});
```

There is an handler for each property of the `Update` object

- onMessage
- onEditedMessage
- onChannelPost
- onEditedChannelPost
- onInlineQuery
- onChosenInlineResult
- onCallbackQuery
- onShippingQuery
- onPreCheckoutQuery
- onPoll
- onPollAnswer

# Helper Handlers

There are some handy handlers, that simplifies special tasks, such as handling text messages and commands.  
They are:  
- `onTextMessage`: Same as `onMessage`, but it handles only text messages (not stickers, photos, etc).  
- `onText`: Accept another parameter `$pattern`, that can be text or a regex, and will used to check text matching.  
- `onCommand`: Same as `onText`, but instead of `$pattern` you have a `$commands` parameter, that can be the command name (without slash) or an array of command names. Default prefix for all the commands is `/`, but you can change it in the `command_prefixes` parameter of [Bot settings](construct.md)

In this example, all the handlers do the same thing.

```php
$Bot->onMessage(function (Message $message) {
    if(isset($message->text) && $message->text === "start"){
        $message->reply("This is the Start command");
    }
});

$Bot->onTextMessage(function (Message $message) {
    if($message->text === "start"){
        $message->reply("This is the Start command");
    }
});

$Bot->onText('/start', function (Message $message) {
    $message->reply("This is the Start command");
});

$Bot->onCommand('start', function (Message $message) {
    $message->reply("This is the Start command");
});

```
