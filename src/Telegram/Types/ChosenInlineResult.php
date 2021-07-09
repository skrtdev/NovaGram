<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents a result of an inline query that was chosen by the user and sent to their chat partner.
*/
class ChosenInlineResult extends Type{
    
    /** @var string The unique identifier for the result that was chosen */
    public string $result_id;

    /** @var User The user that chose the result */
    public User $from;

    /** @var Location|null Sender location, only for bots that require user location */
    public ?Location $location = null;

    /** @var string|null Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message. Will be also received in callback queries and can be used to edit the message. */
    public ?string $inline_message_id = null;

    /** @var string The query that was used to obtain the result */
    public string $query;

    public function __construct(array $array, Bot $Bot = null){
        $this->result_id = $array['result_id'];
        $this->from = new User($array['from'], $Bot);
        $this->location = isset($array['location']) ? new Location($array['location'], $Bot) : null;
        $this->inline_message_id = $array['inline_message_id'] ?? null;
        $this->query = $array['query'];
        parent::__construct($array, $Bot);
    }
    
    
}
