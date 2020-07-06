<?php
header('Content-Type: application/json');
require __DIR__ . '/vendor/autoload.php';

$Bot = new TelegramBot("YOUR_TOKEN", [
    "debug" => true, // will send you api errors when they occurs
    "debug_chat_id" => TUOCHATID, // chat id where debug will be sent
    "json_payload" => true, // allow use of json payload (without this, all the api calls will be made normally, even if they should be made as json payload)
]);

$update = $Bot->update; // this is the update received from the bot


if($update->has("message")){ // update is a message

    $message = $update->message;
    $chat = $message->chat;
    $user = $message->from;

    if($message->has("text")){ // update message contains text

        $chat->sendMessage($message->text); // send a Message in the Chat. Text is the same as the just received message

    }
    else $chat->sendMessage("that's not text", true); // Message doesn't cointain text

}


?>
