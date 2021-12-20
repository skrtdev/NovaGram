<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a service message about a voice chat ended in the chat.
*/
class VoiceChatEnded extends Type{
    
    /** @var int Voice chat duration in seconds */
    public int $duration;

    public function __construct(array $array, Bot $Bot = null){
        $this->duration = $array['duration'];
        parent::__construct($array, $Bot);
    }
    
    
}
