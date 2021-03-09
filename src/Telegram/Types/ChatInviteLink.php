<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Represents an invite link for a chat.
*/
class ChatInviteLink extends Type{

    use simpleProto;

    /** @var string The invite link. If the link was created by another chat administrator, then the second part of the link will be replaced with “…”. */
    public string $invite_link;

    /** @var User Creator of the link */
    public User $creator;

    /** @var bool True, if the link is primary */
    public bool $is_primary;

    /** @var bool True, if the link is revoked */
    public bool $is_revoked;

    /** @var int|null Point in time (Unix timestamp) when the link will expire or has been expired */
    public ?int $expire_date = null;

    /** @var int|null Maximum number of users that can be members of the chat simultaneously after joining the chat via this invite link; 1-99999 */
    public ?int $member_limit = null;


}

?>
