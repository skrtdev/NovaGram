<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a service message about new members invited to a voice chat.
*/
class VoiceChatParticipantsInvited extends Type{
    
    /** @var ObjectsList|null New members that were invited to the voice chat */
    public ?ObjectsList $users = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->users = isset($array['users']) ? new ObjectsList(iterate($array['users'], fn($item) => new User($item, $Bot))) : null;
        parent::__construct($array, $Bot);
    }
    
    
}
