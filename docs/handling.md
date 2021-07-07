# Updates Handling

In order to handle different kinds of updates, you can put all your in code in the `onUpdate` handler, or split it across different handlers (e.g. `onMessage`, `onCallbackQuery`)

```php
use skrtdev\Telegram\Update;

$Bot->onUpdate(function (Update $update) use ($Bot) {
    if(isset($update->message)){
        $message = $update->message;
        $message->reply('You just sent a message');
    }
});
```

```php
use skrtdev\Telegram\Message;

$Bot->onMessage(function (Message $message) use ($Bot) {
    $message->reply('You just sent a message');
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
use skrtdev\Telegram\Message;

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
use skrtdev\Telegram\Message;

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
use skrtdev\Telegram\Message;

$Bot->onCommand('start', function (Message $message, array $args = []) {
    $message->reply('This is the Start command');
});
```

### `onCallbackData`

Similar to `onText`, but for Callback Queries.  
It will check the `$pattern` parameter against [CallbackQuery](types/CallbackQuery.md) data.  
`$pattern` can be a regex too, and you can find `$matches` array in the 2nd parameter of the handler

```php
use skrtdev\Telegram\CallbackQuery;

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
This can handle only users.

```php
use skrtdev\Telegram\{Chat, User};

$Bot->onNewChatMember(function (Chat $chat, User $user, User $adder) {
    $chat->sendMessage("Welcome, {$user->getMention()}");
});
```

### `onNewGroup`

Handles bot being added to groups.  
As you already know that it is your bot, there is no `$user` argument.  
This method uses `onMyChatMember`.

```php
use skrtdev\Telegram\{Chat, User};

$Bot->onNewGroup(function (Chat $chat, User $adder) {
    $chat->sendMessage("Thanks {$adder->getMention()} for adding me to this group!");
});
```

## Filters

PHP8 added support for [Attributes](https://www.php.net/manual/en/language.attributes.overview.php).  
Attributes implemented in NovaGram allow you to filter updates in a nicer way.  
For example if you want a command to work only in private chat, you have to do something like this:
```php
use skrtdev\Telegram\Message;

$Bot->onCommand('mycommand', function (Message $message) {
    $chat = $message->chat;
    
    if($chat->type === 'private'){
        $message->reply('Hello');
    }
});
```
With filters, this looks like:
```php
use skrtdev\NovaGram\Filter;
use skrtdev\Telegram\Message;

$Bot->onCommand('mycommand', #[Filter(is_private: true)] 
    function (Message $message) {
        $message->reply('Hello');
    }
);
```
You may say it is just some lines of code, but if you have some complicated criteria, filters can save you a lot of time.  
Let's assume you want to get only photos sent by you in a private chat with your bot:  
```php
use skrtdev\Telegram\Message;

$Bot->onMessage(function (Message $message) {
    $chat = $message->chat;
    $user = $message->from ?? null;
    
    if($chat->type === 'private' && isset($user) && $user->id === YOUR_ID && isset($message->photo)){
        $message->reply('What a nice photo');
    } 
});
```
With filters this becomes:  
```php
use skrtdev\NovaGram\Filter;
use skrtdev\Telegram\Message;

$Bot->onMessage(#[Filter(user: YOUR_ID, is_private: true, is_photo: true)]
    function (Message $message) {
        $message->reply('What a nice photo');
    }
);
```
You can also pass an array of ids, and you can also combine more filters (this acts like OR, it's the same as creating the same handler more times with different filters)
```php
use skrtdev\NovaGram\Filter;
use skrtdev\Telegram\Message;

$Bot->onMessage(
    #[Filter(user: [8376182, 13874253], is_private: true)]
    #[Filter(group: [-100837618232, -100413874253])]
    #[Filter(is_reply: true, is_photo: true)]
    #[Filter(is_inline: true)]
    #[Filter(is_forwarded: true)]
    function (Message $message) {
        $message->reply('Filters are cool');
    }
);
```

You don't have to worry about Filters' performance impact, as they make bot even faster, compared to in-closure checking.  

## CommandScope
Bot [API 5.3](https://core.telegram.org/bots/api#june-25-2021) introduced [Command Scopes](https://core.telegram.org/bots/api#botcommandscope).  
You can now set commands which are displayed only to specific users and/or chats.  
```php
use skrtdev\NovaGram\CommandScope;
use skrtdev\Telegram\Message;

$Bot->onCommand('private', 
    function(Message $message){
        $message->reply('Hello, this is a private chat');
    },
    new CommandScope('all_private_chats')
);
```
This will show `/private` only in private chats, and will internally add a private chat filter to the handler.  
You can also show commands only to specific chats: imagine you're making some `admin` commands that should be only available to you.
```php
use skrtdev\NovaGram\CommandScope;
use skrtdev\Telegram\Message;

$Bot->onCommand('admin', 
    function(Message $message){
        $message->reply('Hello, this is an admin command');
    },
    new CommandScope(chat_id: YOUR_ID)
);
```
`/admin` command will be shown only to you, and obviously handler won't be triggered if it's not you.  

Even if BOT Api doesn't support multiple chats/users for the same command, NovaGram implements that.
```php
use skrtdev\NovaGram\CommandScope;
use skrtdev\Telegram\Message;

$Bot->onCommand('command', 
    function(Message $message){
        $message->reply('Hello, this is a command which works only in specific chats');
    },
    [new CommandScope('all_private_chats', language_code: 'en'), new CommandScope(chat_id: [-10061523715, -100378636312, -1003876716234])]
);
```
This command will be shown and will work in all the private chats and in those groups.  

The only scopes which are not fully implemented in NovaGram are `all_chat_administrators` and `chat_administrators`: they will filter commands sent by anyone, letting you implement your own logic.  

You can also combine Command Scopes and Filters!

```php
use skrtdev\NovaGram\{CommandScope, Filter};
use skrtdev\Telegram\Message;

$Bot->onCommand('reply', 
    #[Filter(is_reply: true)]
    function(Message $message){
        $message->reply('Hello, this is a command which works only when replying in groups');
    },
    new CommandScope('all_group_chats')
);
```