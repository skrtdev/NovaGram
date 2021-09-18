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
use skrtdev\NovaGram\Exception as NovaGramException;
use skrtdev\Telegram\Exception as TelegramException;

$Bot = new Bot('YOUR_TOKEN');


$Bot->onCommand('novagram', function (Message $message) {
    throw new NovaGramException('Sample Exception');
});

$Bot->onCommand('telegram', function (Message $message) use ($Bot) {
    $Bot->sendMessage(0, 'uh');
});

$Bot->onCommand('getUpdates', function (Message $message) use ($Bot) {
    $Bot->getUpdates();
});

$Bot->onCommand('exception', function (Message $message) {
    throw new Exception('Sample Exception');
});

$Bot->onCommand('error', function (Message $message) {
    throw new Error('Sample Error');
});


$Bot->addErrorHandler(function (NovaGramException $e) {
    print('Caught '.get_class($e).' exception from speficic handler'.PHP_EOL);
});

$Bot->addErrorHandler(function (TelegramException $e) {
    print('Caught '.get_class($e).' exception from speficic handler'.PHP_EOL);
});

$Bot->addErrorHandler(function (Throwable $e) {
    print('Caught '.get_class($e).' exception from general handler'.PHP_EOL);
    print($e.PHP_EOL);
});
// the same exception can be handled by more than one handler

$Bot->start();

