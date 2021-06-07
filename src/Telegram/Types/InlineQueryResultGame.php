<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents a Game.
*/
class InlineQueryResultGame extends Type{
    
    protected string $_ = 'InlineQueryResultGame';

    /** @var string Type of the result, must be game */
    public string $type;

    /** @var string Unique identifier for this result, 1-64 bytes */
    public string $id;

    /** @var string Short name of the game */
    public string $game_short_name;

    /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
    public ?InlineKeyboardMarkup $reply_markup = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->type = $array['type'];
        $this->id = $array['id'];
        $this->game_short_name = $array['game_short_name'];
        $this->reply_markup = isset($array['reply_markup']) ? new InlineKeyboardMarkup($array['reply_markup'], $Bot) : null;
        parent::__construct($array, $Bot);
   }
    
}
