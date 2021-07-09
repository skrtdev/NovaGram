<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents a location to which a chat is connected.
*/
class ChatLocation extends Type{
    
    /** @var Location The location to which the supergroup is connected. Can't be a live location. */
    public Location $location;

    /** @var string Location address; 1-64 characters, as defined by the chat owner */
    public string $address;

    public function __construct(array $array, Bot $Bot = null){
        $this->location = new Location($array['location'], $Bot);
        $this->address = $array['address'];
        parent::__construct($array, $Bot);
    }
    
    
}
