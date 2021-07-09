<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents changes in the status of a chat member.
*/
class ChatMemberUpdated extends Type{
    
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

    public function __construct(array $array, Bot $Bot = null){
        $this->chat = new Chat($array['chat'], $Bot);
        $this->from = new User($array['from'], $Bot);
        $this->date = $array['date'];
        $this->old_chat_member = new ChatMember($array['old_chat_member'], $Bot);
        $this->new_chat_member = new ChatMember($array['new_chat_member'], $Bot);
        $this->invite_link = isset($array['invite_link']) ? new ChatInviteLink($array['invite_link'], $Bot) : null;
        parent::__construct($array, $Bot);
    }
    
    
}
