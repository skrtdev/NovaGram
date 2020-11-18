<?php
require __DIR__ . '/vendor/autoload.php';
/*
    if hosting:
    require "../PHPEasyGit/autoload.php";
*/

use skrtdev\NovaGram\Bot;
use skrtdev\Telegram\Message;

$Bot = new Bot("YOUR_TOKEN", [
    "debug" => YOURCHATID, // chat id where debug will be sent when api errors occurs
    "json_payload" => true, // allow use of json payload (without this, all the api calls will be made normally, even if they should be made as json payload)
]);

$Bot->onMessage(function (Messsage $message) use ($Bot) { // update is a message

    $chat = $message->chat;
    $user = $message->from;

    if(isset($message->text)){ // update message contains text
        $chat->sendMessage($message->text); // send a Message in the Chat. Text is the same as the just received message
    }
    else{
        $chat->sendMessage("that's not text", true); // Message doesn't cointain text
    }

});


?>
