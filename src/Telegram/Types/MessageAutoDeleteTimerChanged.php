<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a service message about a change in auto-delete timer settings.
*/
class MessageAutoDeleteTimerChanged extends Type{
    
    /** @var int New auto-delete time for messages in the chat; in seconds */
    public int $message_auto_delete_time;

    public function __construct(array $array, Bot $Bot = null){
        $this->message_auto_delete_time = $array['message_auto_delete_time'];
        parent::__construct($array, $Bot);
    }
    
    
}
