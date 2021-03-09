<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents a service message about a change in auto-delete timer settings.
*/
class MessageAutoDeleteTimerChanged extends Type{

    use simpleProto;

    /** @var int New auto-delete time for messages in the chat */
    public int $message_auto_delete_time;


}

?>
