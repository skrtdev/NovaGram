<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object contains information about one answer option in a poll.
*/
class PollOption extends Type{
    
    /** @var string Option text, 1-100 characters */
    public string $text;

    /** @var int Number of users that voted for this option */
    public int $voter_count;

    public function __construct(array $array, Bot $Bot = null){
        $this->text = $array['text'];
        $this->voter_count = $array['voter_count'];
        parent::__construct($array, $Bot);
    }
    
    
}
