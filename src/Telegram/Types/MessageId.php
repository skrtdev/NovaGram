<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a unique message identifier.
*/
class MessageId extends Type{
    
    /** @var int Unique message identifier */
    public int $message_id;

    public function __construct(array $array, Bot $Bot = null){
        $this->message_id = $array['message_id'];
        parent::__construct($array, $Bot);
    }
    
    
}
