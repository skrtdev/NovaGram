<?php
if (file_exists('vendor')) {
    require 'vendor/autoload.php';
}
else{
    if (!file_exists('novagram.phar')) {
        copy('http://gaetano.cf/novagram/phar.php', 'novagram.phar');
    }
    require_once 'novagram.phar';
}

use skrtdev\NovaGram\Bot;
use skrtdev\Telegram\Message;

$Bot = new Bot("YOUR_TOKEN", [
    "debug" => YOURCHATID, // chat id where debug will be sent when api errors occurs
]);

$Bot->onMessage(function (Message $message) use ($Bot) { // update is a message

    $chat = $message->chat;
    $user = $message->from;

    if(isset($message->text)){ // update message contains text
        $chat->sendMessage($message->text, true); // send a Message in the Chat. Text is the same as the just received message
    }
    else{
        $chat->sendMessage("that's not text", true); // Message doesn't cointain text
    }

});

?>
