<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents the content of a media message to be sent. It should be one of
*/
class InputMedia extends Type{
    
    protected string $_ = 'InputMedia';

    
    public function __construct(array $array, Bot $Bot = null){
        parent::__construct($array, $Bot);
   }
    
}
