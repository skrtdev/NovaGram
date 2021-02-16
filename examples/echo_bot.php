<?php
if (file_exists('vendor')) {
    require 'vendor/autoload.php';
}
else{
    if (!file_exists('novagram.phar')) {
        copy('https://novagram.ga/phar', 'novagram.phar');
    }
    require_once 'novagram.phar';
}

use skrtdev\NovaGram\Bot;
use skrtdev\Telegram\Message;

$Bot = new Bot('YOUR_TOKEN', [
    'debug' => YOURCHATID, // chat id where debug will be sent when api errors occurs
]);

$Bot->onTextMessage(function (Message $message) use ($Bot) { // update is a message and contains text
    $chat = $message->chat;
    $message->copy(); // copy the message in the same chat
});

$Bot->start();
?>
