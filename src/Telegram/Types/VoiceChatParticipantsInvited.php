<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents a service message about new members invited to a voice chat.
*/
class VoiceChatParticipantsInvited extends Type{

    use simpleProto;

    /** @var ObjectsList|null New members that were invited to the voice chat */
    public ?ObjectsList $users = null;


}

?>
