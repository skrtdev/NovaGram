<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents one row of the high scores table for a game.
*/
class GameHighScore extends \Telegram\GameHighScore{

    use simpleProto;

    /** @var int Position in high score table for the game */
    public int $position;

    /** @var User User */
    public User $user;

    /** @var int Score */
    public int $score;

    
}

?>
