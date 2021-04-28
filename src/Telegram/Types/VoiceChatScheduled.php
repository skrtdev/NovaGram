<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents a service message about a voice chat scheduled in the chat.
*/
class VoiceChatScheduled extends Type{

    use simpleProto;

    /** @var int Point in time (Unix timestamp) when the voice chat is supposed to be started by a chat administrator */
    public int $start_date;


}

?>
