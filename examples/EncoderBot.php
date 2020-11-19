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
/*
    if hosting:
    require "../PHPEasyGit/autoload.php";
*/

use skrtdev\NovaGram\Bot;
use skrtdev\Telegram\{Message, CallbackQuery};

$Bot = new Bot("YOUR_TOKEN", [
    "debug" => YOURCHATID, // chat id where debug will be sent when api errors occurs
    "parse_mode" => "HTML" // will set parse_mode automatically in methods that require it if not providedå
]);

$Bot->onMessage(function (Messsage $message) use ($Bot) { // update is a message

    $chat = $message->chat;
    $user = $message->from;

    if(isset($message->text)){ // update message contains text
                            // Message Text
        $chat->sendMessage("Text: \n<code>".$update->message->text."</code>", [ // send a Message in the Chat
            "reply_markup" => [
                "inline_keyboard" => [ // Message Inline Keyboard
                    [
                        [
                            "text" => "MD5",
                            "callback_data" => md5($message->text)
                        ],
                        [
                            "text" => "sha256",
                            "callback_data" => hash("sha256", $message->text)
                        ],
                        [
                            "text" => "sha1",
                            "callback_data" => hash("sha1", $message->text)
                        ]
                    ]
                ]
            ]
        ], true); // this true will print this api call as json payload

    }
    else $chat->sendMessage("that's not text", true); // Message doesn't cointain text

});

$Bot->onMessage(function (CallbackQuery $callback_query) use ($Bot) { // update is a callback query

    $user = $callback_query->from;

    $message = $callback_query->message;
    $chat = $message->chat;

    $callback_query->answer("Encoded!"); // answer this CallbackQuery

    $message->editText($callback_query->data, true); // edit previously sent Message text with the data of this CallbackQuery

});

?>
