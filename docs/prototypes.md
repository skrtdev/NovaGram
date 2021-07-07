# Extending NovaGram

NovaGram has a JS-like [Prototypes](https://github.com/skrtdev/prototypes) System, that you can use in order to extend the library  

## Add new Methods

Let's make an handler for pinned messages.

```php
use skrtdev\NovaGram\Bot;
use skrtdev\Telegram\Message;

Bot::addMethod('onPinnedMessage', function (Closure $handler): void {
    /** @var Bot $this */
    $this->onMessage($handler, null, fn(Message $message) => isset($message->pinned_message));
});

$Bot = new Bot('TOKEN');

// usage:
$Bot->onPinnedMessage(function(Message $message){
    $pinned_message = $message->pinned_message; 
    $pinned_message->reply('This message has just been pinned');
});
```

The 1st parameter is the method name, the 2nd is the method itself, in form of Closure (anonymous function).  
The arguments passed to the Closure are all the arguments passed to the method.  
Inside the Closure, `$this` refers to the instance of the Object - in this case instance of `skrtdev\NovaGram\Bot`.

```php
use skrtdev\NovaGram\Bot;
use skrtdev\Telegram\Message;

Bot::addMethod('onForwardedMessage', function (Closure $handler): void {
    /** @var Bot $this */
    $this->onMessage($handler, null, fn(Message $message) => isset($message->forward_date));
});


$Bot->onForwardedMessage(function(Message $message){
    $chat = $message->chat;
    $chat->sendMessage('You can\'t forward messages in this chat');
    $message->delete();
});
```

With prototypes you can only add methods, not modify behaviour of existent methods.
