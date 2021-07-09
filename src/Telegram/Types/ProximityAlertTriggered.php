<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents the content of a service message, sent whenever a user in the chat triggers a proximity alert set by another user.
*/
class ProximityAlertTriggered extends Type{
    
    /** @var User User that triggered the alert */
    public User $traveler;

    /** @var User User that set the alert */
    public User $watcher;

    /** @var int The distance between the users */
    public int $distance;

    public function __construct(array $array, Bot $Bot = null){
        $this->traveler = new User($array['traveler'], $Bot);
        $this->watcher = new User($array['watcher'], $Bot);
        $this->distance = $array['distance'];
        parent::__construct($array, $Bot);
    }
    
    
}
