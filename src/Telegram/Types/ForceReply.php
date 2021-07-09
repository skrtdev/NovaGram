<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Upon receiving a message with this object, Telegram clients will display a reply interface to the user (act as if the user has selected the bot's message and tapped 'Reply'). This can be extremely useful if you want to create user-friendly step-by-step interfaces without having to sacrifice privacy mode.
*/
class ForceReply extends Type{
    
    /** @var bool Shows reply interface to the user, as if they manually selected the bot's message and tapped 'Reply' */
    public bool $force_reply;

    /** @var string|null The placeholder to be shown in the input field when the reply is active; 1-64 characters */
    public ?string $input_field_placeholder = null;

    /** @var bool|null Use this parameter if you want to force reply from specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message. */
    public ?bool $selective = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->force_reply = $array['force_reply'];
        $this->input_field_placeholder = $array['input_field_placeholder'] ?? null;
        $this->selective = $array['selective'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
