<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a service message about a voice chat started in the chat. Currently holds no information.
*/
class VoiceChatStarted extends Type{
    
    
    public function __construct(array $array, Bot $Bot = null){
        parent::__construct($array, $Bot);
    }
    
    
}
