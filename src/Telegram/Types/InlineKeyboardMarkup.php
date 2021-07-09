<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents an inline keyboard that appears right next to the message it belongs to.
*/
class InlineKeyboardMarkup extends Type{
    
    /** @var ObjectsList Array of button rows, each represented by an Array of InlineKeyboardButton objects */
    public ObjectsList $inline_keyboard;

    public function __construct(array $array, Bot $Bot = null){
        $this->inline_keyboard = new ObjectsList(iterate($array['inline_keyboard'], fn($item) => new ObjectsList(iterate($item, fn($item) => new InlineKeyboardButton($item, $Bot)))));
        parent::__construct($array, $Bot);
    }
    
    
}
