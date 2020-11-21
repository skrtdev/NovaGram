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

#use skrtdev\NovaGram\Bot;
use skrtdev\NovaGram\Bot;
use skrtdev\Telegram\Message;
use skrtdev\NovaGram\Exception as NovaGramException;
use skrtdev\Telegram\Exception as TelegramException;

$Bot = new Bot(readline("Insert Bot token: "));


$Bot->onMessage(function (Message $message) use ($Bot) { // update is a message

    $chat = $message->chat;

    if(isset($message->from)){ // message has a sender
        $user = $message->from;
        $text = $message->text;

        if($text === "/novagram"){
            throw new NovaGramException("Sample Exception");
        }
        if($text === "/telegram"){
            $Bot->sendMessage(0, "uh");
        }
        if($text === "/getUpdates"){
            $Bot->getUpdates(["timeout" => 300]);
            (new skrtdev\async\Pool)->parallel(function () use ($Bot) {
                $Bot->getUpdates(["timeout" => 300]);
            });
        }
        if($text === "/exception"){
            throw new \Exception("Sample Exception");
        }
        if($text === "/error"){
            throw new \Error("Sample Error");
        }
    }
});

$Bot->addErrorHandler(function (NovaGramException $e) {
    print("Caught ".get_class($e)." exception from speficic handler".PHP_EOL);
});

$Bot->addErrorHandler(function (TelegramException $e) {
    print("Caught ".get_class($e)." exception from speficic handler".PHP_EOL);
});

$Bot->addErrorHandler(function (Throwable $e) {
    print("Caught ".get_class($e)." exception from general handler".PHP_EOL);
    print($e.PHP_EOL);
});
// the same exception can be handled by more than one handler

?>
