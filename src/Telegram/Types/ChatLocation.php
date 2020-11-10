<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Represents a location to which a chat is connected.
*/
class ChatLocation extends \Telegram\ChatLocation{

    use simpleProto;

    /** @var Location The location to which the supergroup is connected. Can't be a live location. */
    public Location $location;

    /** @var string Location address; 1-64 characters, as defined by the chat owner */
    public string $address;

    
}

?>
