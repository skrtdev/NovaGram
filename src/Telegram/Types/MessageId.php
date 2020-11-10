<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents a unique message identifier.
*/
class MessageId extends \Telegram\MessageId{

    use simpleProto;

    /** @var int Unique message identifier */
    public int $message_id;

    
}

?>
