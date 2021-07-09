<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents type of a poll, which is allowed to be created and sent when the corresponding button is pressed.
*/
class KeyboardButtonPollType extends Type{
    
    /** @var string|null If quiz is passed, the user will be allowed to create only polls in the quiz mode. If regular is passed, only regular polls will be allowed. Otherwise, the user will be allowed to create a poll of any type. */
    public ?string $type = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->type = $array['type'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
