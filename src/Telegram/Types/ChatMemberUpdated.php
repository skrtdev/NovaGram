<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents changes in the status of a chat member.
*/
class ChatMemberUpdated extends Type{

    use simpleProto;

    /** @var Chat Chat the user belongs to */
    public Chat $chat;

    /** @var User Performer of the action, which resulted in the change */
    public User $from;

    /** @var int Date the change was done in Unix time */
    public int $date;

    /** @var ChatMember Previous information about the chat member */
    public ChatMember $old_chat_member;

    /** @var ChatMember New information about the chat member */
    public ChatMember $new_chat_member;

    /** @var ChatInviteLink|null Chat invite link, which was used by the user to join the chat; for joining by invite link events only. */
    public ?ChatInviteLink $invite_link = null;


}

?>
