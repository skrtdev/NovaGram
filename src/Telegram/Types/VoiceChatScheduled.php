<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a service message about a voice chat scheduled in the chat.
*/
class VoiceChatScheduled extends Type{
    
    /** @var int Point in time (Unix timestamp) when the voice chat is supposed to be started by a chat administrator */
    public int $start_date;

    public function __construct(array $array, Bot $Bot = null){
        $this->start_date = $array['start_date'];
        parent::__construct($array, $Bot);
    }
    
    
}
