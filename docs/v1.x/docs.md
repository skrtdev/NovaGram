# Documentation
--------  
> All the BOTApi's methods can be used as methods of the Bot class.  
> There are only this library own methods  
--------  

### Setup Script
All the methods explained here are supposed to be in a script with this setup:
```php
require __DIR__ . '/vendor/autoload.php';

$Bot = new \skrtdev\NovaGram\Bot("YOUR_TOKEN");

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
   * [sendMessage](#sendmessage)
   * [forwardMessage](#forwardmessage)
   * [deleteMessage](#deletemessage)
   * [answerCallbackQuery](#answercallbackquery)
   * [editMessageText](#editmessagetext)
   * [sendChatAction](#sendchataction)
   * [getUserProfilePhotos](#getuserprofilephotos)
   * [getUsernameDC](#getusernamedc)


### sendMessage
sendMessage can be used directly as a method of the main class, or as a method of a Chat Object.  
> Returns the sent Message object.

```php
// main class
$Bot->sendMessage(01234567, "message_text");

// Chat object
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
deleteMessage can be used directly as a method of the main class, as a method of a Message Object (just delete that message) or as a method of a Chat Object, in order to delete a message in that Chat.

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

$CallbackQuery->answer("text", [
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

$message->editText("<b>new text</b>", [
    "parse_mode" => "html"
]);
```

### sendChatAction
sendChatAction can be used directly as a method of the main class or as a method of a Chat Object, as _sendAction_ method, in order to send an Action that Chat.
> Default Action if not specified is `typing`

```php
// main class
$Bot->sendChatAction([
    "chat_id" => 01234567,
    "action" => "typing"
]);

// Chat object
$chat->sendAction(); // same as below
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

$user->getProfilePhotos(10, [
    "offset" => 5
]);
```

### getUsernameDC

> DC means DataCenter, that is the server where the user account is located

getUsernameDC is a static method of the main class but you can use it also as a method of a User Object, as _getDC_ method, in order to get DC of that User.


In order to retrieve DC, user need to have username and profile photo.

getDC will throw a \\NovaGram\\Exception if Object is not an User, or if User hasn't got an Username, and will return `false` if User hasn't got a profile photo.

> Returns an integer corresponding to User DC in case of success.

```php
// main class
Bot::getUsernameDC("skrtdev");

// User object
$user->getDC();
```
