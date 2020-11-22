<?php

require __DIR__ . '/../vendor/autoload.php';

use skrtdev\NovaGram\Bot;
use skrtdev\Telegram\TooManyRequestsException;

use skrtdev\async\Pool;

$Bot = new Bot(readline("Insert Bot token: "));

$pool = new Pool(300);

$chat_id = readline("Insert your chat_id: ");

for ($i=0; $i < 300; $i++) {
    $pool->parallel(function () use ($Bot, $chat_id) {
        while (true) {
            try{
                $Bot->sendMessage($chat_id, "a");
                break;
            }
            catch(TooManyRequestsException $e){
                $seconds = $e->response['parameters']['retry_after'];
                echo "Sleeping for $seconds seconds", PHP_EOL;
                sleep($seconds);
            }
        }
    });
}

?>
