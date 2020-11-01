<?php

require __DIR__ . '/../vendor/autoload.php';

use skrtdev\NovaGram\Bot;
use skrtdev\Telegram\Exception as TelegramException;

use skrtdev\async\Pool;

$Bot = new Bot(readline("Insert Bot token: "));

$pool = new Pool(300);

$chat_id = readline("Insert your chat_id: ");

for ($i=0; $i < 300; $i++) {
    $pool->parallel(function () use ($Bot, $chat_id) {
        $Bot->sendMessage($chat_id, "a");
    });
}

?>
