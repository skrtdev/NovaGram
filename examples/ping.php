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


$Bot = new Bot('YOUR_TOKEN');

$Bot->onCommand('start', function (Message $message) {
    $message->reply("/ping\n\n/moon");
});

$Bot->onCommand('ping', function (Message $message) {
    $chat = $message->chat;

    $started = hrtime(true)/10**9;
    $mex = $chat->sendMessage('Pong.');
    $mex->editText('Ping: '.(((hrtime(true)/10**9)-$started)*1000).'ms', true);
});

$Bot->onCommand('moon', function (Message $message) {
    $chat = $message->chat;

    $emojis = '🌑🌒🌓🌔🌕🌖🌗🌘🌑';
    $mex = $chat->sendMessage($emojis);
    for ($n=0; $n < 4; $n++) {
        for ($i=0; $i < strlen($emojis)+$n+1; $i++) {
            $thistext = mb_substr($emojis, $i, null, 'UTF-8').mb_substr($emojis, 0, $i, 'UTF-8');
            if ($thistext === $emojis) continue;
            $mex->editText($thistext);
            usleep(75);
        }
    }
    $mex->editText($emojis);
});


$Bot->setErrorHandler(function(Throwable $e) {
    print('uff, another exception occured:'.PHP_EOL);
    print($e);
    print(PHP_EOL);
});

$Bot->start();
