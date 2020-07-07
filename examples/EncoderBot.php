<?php
header('Content-Type: application/json');
require __DIR__ . '/vendor/autoload.php';
/*
    if hosting:
    require "../PHPEasyGit/autoload.php";
*/

$Bot = new TelegramBot("YOUR_TOKEN", [
    "debug" => YOURCHATID, // chat id where debug will be sent when api errors occurs
    "json_payload" => true, // allow use of json payload (without this, all the api calls will be made normally, even if they should be made as json payload)
    "parse_mode" => "HTML" // will set parse_mode automatically in methods that require it if not providedå
]);

$update = $Bot->update; // this is the update received from the bot

if(isset($update->message)){ // update is a message

    $message = $update->message;
    $chat = $message->chat;
    $user = $message->from;

    if(isset($message->text)){ // update message contains text

        $chat->sendMessage([ // send a Message in the Chat
            "text" => "Testo: \n<code>".$update->message->text."</code>", // Message Text
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

}
if(isset($update->callback_query)){ // update is a callback query

    $callback_query = $update->callback_query;
    $user = $callback_query->from;

    $message = $callback_query->message;
    $chat = $message->chat;

    $callback_query->answer("Encoded!"); // answer this CallbackQuery

    $message->editText($callback_query->data, true); // edit previously sent Message text with the data of this CallbackQuery

}

?>
