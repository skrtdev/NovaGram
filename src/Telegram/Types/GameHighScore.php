<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents one row of the high scores table for a game.
*/
class GameHighScore extends Type{
    
    /** @var int Position in high score table for the game */
    public int $position;

    /** @var User User */
    public User $user;

    /** @var int Score */
    public int $score;

    public function __construct(array $array, Bot $Bot = null){
        $this->position = $array['position'];
        $this->user = new User($array['user'], $Bot);
        $this->score = $array['score'];
        parent::__construct($array, $Bot);
    }
    
    
}
