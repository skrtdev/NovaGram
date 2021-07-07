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
use skrtdev\Telegram\{CallbackQuery, Message};

$Bot = new Bot('YOUR_TOKEN');

$Bot->onCommand('start', function (Message $message) { // handles start command
    $user = $message->from;
    $inline []= [button('This is a single button in a row ', 'single_button')];
    $inline []= [button('This is the first button of this row', 'first_row_button'), button('This is the second button of this row', 'second_row_button')];
    $inline []= [button('This is an url button', 'https://novagram.ga', true)]; // this true means it is an url
    $message->reply("Hi {$user->getMention()}, this is a demo bot for inline keyboards", ['reply_markup' => ['inline_keyboard' => $inline]]);
});

$Bot->onCallbackData('single_button', function(CallbackQuery $callback_query){
    $message = $callback_query->message;
    $message->editText('This is single button\'s content, click /start to go back');
});

$Bot->onCallbackData('first_row_button', function(CallbackQuery $callback_query){
    $message = $callback_query->message;
    $message->editText('This is first row button\'s content, click /start to go back');
});

$Bot->onCallbackData('second_row_button', function(CallbackQuery $callback_query){
    $message = $callback_query->message;
    $message->editText('This is second row button\'s content, very boring, but this is just an example.'.PHP_EOL.'Click /start to go back');
});

$Bot->onCallbackQuery(fn(CallbackQuery $callback_query) => $callback_query->answer()); // answer all the callback queries

$Bot->start();
