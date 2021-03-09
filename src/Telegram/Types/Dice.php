<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents an animated emoji that displays a random value.
*/
class Dice extends \Telegram\Dice{

    use simpleProto;

    /** @var string Emoji on which the dice throw animation is based */
    public string $emoji;

    /** @var int Value of the dice, 1-6 for “🎲”, “🎯” and “🎳” base emoji, 1-5 for “🏀” and “⚽” base emoji, 1-64 for “🎰” base emoji */
    public int $value;

    
}

?>
