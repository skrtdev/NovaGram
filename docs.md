# Documentation
--------
> All the BOTApi's methods can be used as methods of the TelegramBot class.
> There are only this library own methods
--------

## Creating the class
Create a variable (in this Documentation it's called $Bot) and instanciate the TelegramBot Class. Parameters are:
   * token (string)
   * settings (array)

A simple example:
```php
header('Content-Type: application/json');
require __DIR__ . '/vendor/autoload.php';

$Bot = new TelegramBot("YOUR_TOKEN", [
    "json_payload" => true
]);
```
In this example, the settings array contains a key `json_payload` set to `true`. Doing so, the first API Call with 2nd parameter set to true will be print as payload, and afterwards processed by Telegram, making the bot **faster**  

### The Settings Array

| key                 | value   | description                                                                             |
|---------------------|---------|-----------------------------------------------------------------------------------------|
| json_payload        | boolean | whether or not print json payload                                                       |
| log_updates         | boolean | whether or not log raw json updates                                                     |
| log_updates_chat_id | int     | chat id where updates will be sent if log_updates is set to true                        |
| debug               | boolean | whether or not send debug when an api error occurs                                      |
| debug_chat_id       | int     | chat id where debug logs will be sent if debug is set to true                           |
| disable_ip_check    | boolean | disable telegram ip check if set to true, any value rather than true won't do anything  |
| disable_webhook     | boolean | disable update receiving if set to true, any value rather than true won't do anything   |


### Setup Script
All the methods explained here are supposed to be in a script with this setup:
```php
header('Content-Type: application/json');
require __DIR__ . '/vendor/autoload.php';

$Bot = new TelegramBot("YOUR_TOKEN", [
   "json_payload" => true
]);

$update = $Bot->update;
$message = $update->message;
$chat = $message->chat;
$user = $message->from;
```

## All Methods
How to use any BOTApi Method:
```php
$Bot->METHOD_NAME([
    "field1_name" => "field1_value",
    "field2_name" => "field2_value"
])
```

### Available Methods
   * [reply](#reply)
   * [sendMessage](#sendMessage)
   * [forwardMessage](#forwardMessage)
   * [deleteMessage](#deleteMessage)
   * [answerCallbackQuery](#answerCallbackQuery)
   * [editMessageText](#editMessageText)
   * [sendChatAction](#sendChatAction)
   * [getUserProfilePhotos](#getUserProfilePhotos)
   * [getUserDC](#getUserDC)


### reply
> reply will be removed in a future version

reply can be used only as a method of an Update Object.
reply acts just like sendMessage, sending a message in the Update chat with the specified text.

```php
// Update object
$update->reply([
    "text" => "message_text"
]);

/* or simply */

// Update object
$update->reply("message_text"); // just the text of the message
```


### sendMessage
sendMessage can be used directly as a method of the main class, or as a method of a Chat Object.

> Returns the sent Message object.

```php
// main class
$Bot->sendMessage([
    "chat_id" => 01234567,
    "text" => "message_text"
]);

// Chat object
$chat->sendMessage([
    "text" => "message_text"
]);

/* or simply */

// Chat object with just text
$chat->sendMessage("message_text");
```

### forwardMessage
forwardMessage can be used directly as a method of the main class, as a method of a Message Object (just forwards that message) or as a method of a Chat Object, as _forwardTo_ method, in order to forward in that Chat.

> Returns the forwarded Message object.

```php
// main class
$Bot->forwardMessage([
    "chat_id" => 01234567,
    "text" => "message_text"
]);

// Message object
$message->forward(01234567); // just the chat_id of the target chat

// Chat object (forwardTo)
$chat->forwardTo([
    "from_chat_id" => 01234567,
    "message_id" => 0123456789
]);
```

### deleteMessage
deleteMessage can be used directly as a method of the main class, as a method of a Message Object (just delete that message) or as a metod of a Chat Object, in order to delete a message in that Chat.

```php
// main class
$Bot->deleteMessage([
    "chat_id" => 01234567,
    "message_id" => 0123456789
]);

// Chat object
$chat->deleteMessage(0123456789); // just the message_id of the target message

// Message object
$message->delete(); // just delete
```

### answerCallbackQuery
answerCallbackQuery can be used directly as a method of the main class or as a method of a CallbackQuery Object, as _answer_ method, in order to answer that CallbackQuery.

```php
$CallbackQuery = $update->callback_query;

// main class
$Bot->answerCallbackQuery([
    "callback_query_id" => 012345678901234567,
    "text" => "some text"
]);

// CallbackQuery object
$CallbackQuery->answer(); // just answer
$CallbackQuery->answer("text"); // just text

$CallbackQuery->answer([
    "text" => "some text",
    "show_alert" => true
]);
```

### editMessageText
editMessageText can be used directly as a method of the main class or as a method of a Message Object, as _editText_ method, in order to edit that Message.

```php
// main class
$Bot->editMessageText([
    "chat_id" => 01234567,
    "message_id" => 0123456789,
    "text" => "new text"
]);

// Message object
$message->editText("new text"); // just text

$message->editText([
    "text" => "<b>new text</b>",
    "parse_mode" => "html"
]);
```

### sendChatAction
sendChatAction can be used directly as a method of the main class or as a method of a Chat Object, as _sendAction_ method, in order to send an Action that Chat.

```php
// main class
$Bot->sendChatAction([
    "chat_id" => 01234567,
    "action" => "typing"
]);

// Chat object
$chat->sendAction("typing"); // just action
```

### getUserProfilePhotos
getUserProfilePhotos can be used directly as a method of the main class or as a method of a User Object, as _getProfilePhotos_ method, in order to get Profile Photos of that User.

> Returns a UserProfilePhotos object.

```php
// main class
$Bot->getUserProfilePhotos([
    "user_id" => 01234567,
    "limit" => 10
]);

// User object
$user->getProfilePhotos(); // just nothing
$user->getProfilePhotos(10); // just limit

$user->getProfilePhotos([
    "limit" => 10,
    "offset" => 5
]);
```

### getUserDC
getUserDC can be used directly as a method of the main class or as a method of a User Object, as _getDC_ method, in order to get DC of that User.

In order to retrieve DC, user need to have username and profile photo.

getUserDC will throw an error if Object is not an User, or if User hasn't got an Username, and `false` if User hasn't got a profile photo.

> Returns an integer corresponding to User DC in case of success.

```php
// main class
$Bot->getUserDC($user);

// User object
$user->getDC();
```
