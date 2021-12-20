<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents a join request sent to a chat.
*/
class ChatJoinRequest extends Type{
    
    /** @var Chat Chat to which the request was sent */
    public Chat $chat;

    /** @var User User that sent the join request */
    public User $from;

    /** @var int Date the request was sent in Unix time */
    public int $date;

    /** @var string|null Bio of the user. */
    public ?string $bio = null;

    /** @var ChatInviteLink|null Chat invite link that was used by the user to send the join request */
    public ?ChatInviteLink $invite_link = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->chat = new Chat($array['chat'], $Bot);
        $this->from = new User($array['from'], $Bot);
        $this->date = $array['date'];
        $this->bio = $array['bio'] ?? null;
        $this->invite_link = isset($array['invite_link']) ? new ChatInviteLink($array['invite_link'], $Bot) : null;
        parent::__construct($array, $Bot);
    }
    
    
}
