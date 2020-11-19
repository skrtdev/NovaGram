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

use skrtdev\NovaGram\Bot;
use skrtdev\Telegram\Messsage;


$Bot = new Bot("YOUR_TOKEN", [
    #"debug" => 634408248, // chat id where debug will be sent when api errors occurs
    "parse_mode" => "HTML",
    /*"database" => [
        "driver" => "sqlite", // default to mysql
        "host" => "db.sqlite3", // default to localhost:3306
    ]*/
]);

$Bot->onMessage(function (Messsage $message) use ($Bot) { // update is a message

    $chat = $message->chat;

    if(isset($message->from)){ // message has a sender
        $user = $message->from;

        if(isset($message->text)){ // message contains text
            $text = $message->text;

            if($text === "/start"){
                $message->reply("/ping\n\n/moon");
            }

            if($text === "/ping"){
                $started = hrtime(true)/10**9;
                $mex = $chat->sendMessage("Pong.");
                $mex->editText("Ping: ".(((hrtime(true)/10**9)-$started)*1000).'ms', true);
            }

            if($text === "/moon"){
                $emojis = "🌑🌒🌓🌔🌕🌖🌗🌘🌑";
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
            }
        }

    }
});

$Bot->setErrorHandler(function(Throwable $e) {
    print("uff, another exception occured:".PHP_EOL);
    print($e);
    print(PHP_EOL);
});

?>
