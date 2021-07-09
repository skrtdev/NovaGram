<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a bot command.
*/
class BotCommand extends Type{
    
    /** @var string Text of the command, 1-32 characters. Can contain only lowercase English letters, digits and underscores. */
    public string $command;

    /** @var string Description of the command, 3-256 characters. */
    public string $description;

    public function __construct(array $array, Bot $Bot = null){
        $this->command = $array['command'];
        $this->description = $array['description'];
        parent::__construct($array, $Bot);
    }
    
    
}
