<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents an inline keyboard that appears right next to the message it belongs to.
*/
class InlineKeyboardMarkup extends \Telegram\InlineKeyboardMarkup{

    use simpleProto;

    /** @var stdClass Array of button rows, each represented by an Array of InlineKeyboardButton objects */
    public stdClass $inline_keyboard;

    
}

?>
