# Updates Handling

In order to handle different kinds of updates, you can put all your in code in the `onUpdate` handler, or split it across different handlers (e.g. `onMessage`, `onCallbackQuery`)

```php
$Bot->onUpdate(function (Update $update) use ($Bot) {
    if(isset($update->message)){
        $message = $update->message;
        $message->reply('WHAT? A Message?!?');
    }
});
```

```php
$Bot->onMessage(function (Message $message) use ($Bot) {
    $message->reply('WHAT? A Message?!?');
});
```

There is an handler for each property of the `Update` object

- `onMessage`  
- `onEditedMessage`  
- `onChannelPost`  
- `onEditedChannelPost`  
- `onInlineQuery`  
- `onChosenInlineResult`  
- `onCallbackQuery`  
- `onShippingQuery`  
- `onPreCheckoutQuery`  
- `onPoll`  
- `onPollAnswer`  
- `onMyChatMember`  
- `onChatMember`  

## Helper Handlers

> There are some handy handlers, that simplifies special tasks, such as handling text messages and commands.  

### `onTextMessage`

Same as `onMessage`, but it handles only text messages (not stickers, photos, etc)  

```php
$Bot->onMessage(function (Message $message) {
    if(isset($message->text) && $message->text === '/start'){
        $message->reply('This is the Start command');
    }
});

// same as

$Bot->onTextMessage(function (Message $message) {
    if($message->text === '/start'){
        $message->reply('This is the Start command');
    }
});
```

### `onText`

Accepts another parameter `$pattern`, that can be text or a regex, and will used to check text matching. You can find $matches array in the 2nd parameter of the handler

```php
$Bot->onText('/start', function (Message $message, array $matches = []) {
    $message->reply('This is the Start command');
});
```

### `onCommand`

Same as `onText`, but instead of `$pattern` you have a `$commands` parameter, that can be the command name (without slash) or an array of command names.  
Default prefix for all the commands is `/`, but you can change it in the `command_prefixes` parameter of [Bot settings](construct.md)  
`onCommand` will handle commands (for example every message starting with `/start`), and will give you an array of arguments passed to the command in the 2nd parameter of the handler.  
> `/start hello John` will result in an `$args` array like this: `['hello', 'John']`

```php
$Bot->onCommand('start', function (Message $message, array $args = []) {
    $message->reply('This is the Start command');
});
```

### `onCallbackData`

Similar to `onText`, but for Callback Queries.  
It will check the `$pattern` parameter against [CallbackQuery](types/CallbackQuery.md) data.  
`$pattern` can be a regex too, and you can find `$matches` array in the 2nd parameter of the handler

```php
$Bot->onCallbackQuery(function (CallbackQuery $callback_query) {
    if($callback_query->data === 'start'){
        $callback_query->answer('Wow, a Callback Query');
    }
});

// same as

$Bot->onCallbackData('start', function (CallbackQuery $callback_query, array $matches = []) {
    $callback_query->answer('Wow, a Callback Query');
});
```

### `onNewChatMember`

Handles users being added to groups. As the bot can also be added to groups, you can use [onNewGroup handler](#onnewgroup).  
This handles only other users by default, if you want to get bots too, just pass `true` in the 2nd argument.  
Let's compare this method with a canonic `onMessage` usage:  

```php
$Bot->onMessage(function (Message $message) {
    if(isset($message->new_chat_members)){
        $chat = $message->chat;

        foreach ($message->new_chat_members as $user) {
            if($user->is_bot) continue;
            $chat->sendMessage("Welcome, {$user->getMention()}");
        }
    }
});
```
```php
$Bot->onNewChatMember(function (Chat $chat, User $user, User $adder) {
    $chat->sendMessage("Welcome, {$user->getMention()}");
});

// if you want to handle bots too:
$Bot->onNewChatMember(function (Chat $chat, User $user, User $adder) {
    $chat->sendMessage("Welcome, {$user->getMention()}");
}), true);
```

### `onNewGroup`

Handles bot being added to groups.  
As you already know that it is your bot, there is no `$user` argument.  
Let's compare this method with `onNewChatMember` usage:  


```php
$Bot->onNewChatMember(function (Chat $chat, User $user, User $adder) use ($Bot) {
    if($user->id === $Bot->id){
        $chat->sendMessage("Thanks {$adder->getMention()} for adding me to this group!");
    }
}), true);
```
```php
$Bot->onNewGroup(function (Chat $chat, User $adder) {
    $chat->sendMessage("Thanks {$adder->getMention()} for adding me to this group!");
});
```
