<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents an answer of a user in a non-anonymous poll.
*/
class PollAnswer extends Type{
    
    /** @var string Unique poll identifier */
    public string $poll_id;

    /** @var User The user, who changed the answer to the poll */
    public User $user;

    /** @var ObjectsList 0-based identifiers of answer options, chosen by the user. May be empty if the user retracted their vote. */
    public ObjectsList $option_ids;

    public function __construct(array $array, Bot $Bot = null){
        $this->poll_id = $array['poll_id'];
        $this->user = new User($array['user'], $Bot);
        $this->option_ids = new ObjectsList($array['option_ids']);
        parent::__construct($array, $Bot);
    }
    
    
}
