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
