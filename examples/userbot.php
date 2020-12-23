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

use skrtdev\NovaGram\UserBot;
use skrtdev\Telegram\Message;

$Bot = new UserBot("userbot");

$Bot->onTextMessage(function (Message $message) use ($Bot) {
    $chat = $message->chat;
    $chat->sendMessage("You said: ".$message->text, true);
});

?>
