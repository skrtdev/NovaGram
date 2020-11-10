<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Represents a Game.
*/
class InlineQueryResultGame extends \Telegram\InlineQueryResultGame{

    use simpleProto;

    /** @var string Type of the result, must be game */
    public string $type;

    /** @var string Unique identifier for this result, 1-64 bytes */
    public string $id;

    /** @var string Short name of the game */
    public string $game_short_name;

    /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
    public ?InlineKeyboardMarkup $reply_markup = null;

    
}

?>
