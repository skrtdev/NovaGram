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
use skrtdev\Telegram\{Message, CallbackQuery};

$Bot = new Bot('YOUR_TOKEN', [
    'parse_mode' => 'HTML' // will set parse_mode automatically in methods that require it if not providedå
]);

$Bot->onTextMessage(function (Message $message) use ($Bot) { // update is a message and contains text
    $chat = $message->chat;
    $text = $message->text;

    $chat->sendMessage("Text: \n<code>$text</code>", [ // send a Message in the Chat
        'reply_markup' => [
            'inline_keyboard' => [ // Message Inline Keyboard
                [
                    [
                        'text' => 'MD5',
                        'callback_data' => md5($message->text)
                    ],
                    [
                        'text' => 'sha256',
                        'callback_data' => hash('sha256', $message->text)
                    ],
                    [
                        'text' => 'sha1',
                        'callback_data' => hash('sha1', $message->text)
                    ]
                ]
            ]
        ]
    ], true); // this true will execute this api call as json payload

});

$Bot->onCallbackQuery(function (CallbackQuery $callback_query) use ($Bot) { // update is a callback query
    $message = $callback_query->message;

    $callback_query->answer('Encoded!'); // answer this CallbackQuery
    $message->editText($callback_query->data, true); // edit previously sent Message text with the data of this CallbackQuery
});

$Bot->start();
