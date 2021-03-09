<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents a service message about a voice chat ended in the chat.
*/
class VoiceChatEnded extends Type{

    use simpleProto;

    /** @var int Voice chat duration; in seconds */
    public int $duration;


}

?>
