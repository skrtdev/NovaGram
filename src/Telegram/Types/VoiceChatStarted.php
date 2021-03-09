<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents a service message about a voice chat started in the chat. Currently holds no information.
*/
class VoiceChatStarted extends Type{

    use simpleProto;

    /** @var int Voice chat duration; in seconds */
    public int $duration;


}

?>
