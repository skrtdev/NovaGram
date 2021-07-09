<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents the content of a message to be sent as a result of an inline query. Telegram clients currently support the following 5 types:
*/
class InputMessageContent extends Type{
    
    
    public function __construct(array $array, Bot $Bot = null){
        parent::__construct($array, $Bot);
    }
    
    
}
