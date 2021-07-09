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
use skrtdev\Telegram\{CallbackQuery, Chat, Type, Update};

$Bot = new Bot('YOUR_TOKEN', ['parse_mode' => 'HTML']);

function find_chat_object(Type $object): ?Chat {
    foreach ($object as $item) {
        if($item instanceof Type){
            if($item instanceof Chat){
                return $item;
            }
            else{
                $found = find_chat_object($item);
                if(isset($found)){
                    return $found;
                }
            }
        }
    }
    return null;
}

$Bot->onUpdate(function(Update $update){
    if($chat = find_chat_object($update)){
        $chat->sendMessage('<pre>'.htmlspecialchars($update->toJSON()).'</pre>');
    }
});

$Bot->onCallbackQuery(fn(CallbackQuery $callback_query) => $callback_query->answer()); // answer all the callback queries

$Bot->start();
