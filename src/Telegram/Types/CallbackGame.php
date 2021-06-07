<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * A placeholder, currently holds no information. Use BotFather to set up your game.
*/
class CallbackGame extends Type{
    
    protected string $_ = 'CallbackGame';

    
    public function __construct(array $array, Bot $Bot = null){
        parent::__construct($array, $Bot);
   }
    
}
