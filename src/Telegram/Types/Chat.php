<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\{Bot, conversations, dc};

/**
 * This object represents a chat.
*/
class Chat extends Type{
    
    use dc, conversations;

    protected string $_ = 'Chat';

    /** @var int Unique identifier for this chat. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier. */
    public int $id;

    /** @var string Type of chat, can be either “private”, “group”, “supergroup” or “channel” */
    public string $type;

    /** @var string|null Title, for supergroups, channels and group chats */
    public ?string $title = null;

    /** @var string|null Username, for private chats, supergroups and channels if available */
    public ?string $username = null;

    /** @var string|null First name of the other party in a private chat */
    public ?string $first_name = null;

    /** @var string|null Last name of the other party in a private chat */
    public ?string $last_name = null;

    /** @var ChatPhoto|null Chat photo. Returned only in getChat. */
    public ?ChatPhoto $photo = null;

    /** @var string|null Bio of the other party in a private chat. Returned only in getChat. */
    public ?string $bio = null;

    /** @var string|null Description, for groups, supergroups and channel chats. Returned only in getChat. */
    public ?string $description = null;

    /** @var string|null Primary invite link, for groups, supergroups and channel chats. Returned only in getChat. */
    public ?string $invite_link = null;

    /** @var Message|null The most recent pinned message (by sending date). Returned only in getChat. */
    public ?Message $pinned_message = null;

    /** @var ChatPermissions|null Default chat member permissions, for groups and supergroups. Returned only in getChat. */
    public ?ChatPermissions $permissions = null;

    /** @var int|null For supergroups, the minimum allowed delay between consecutive messages sent by each unpriviledged user. Returned only in getChat. */
    public ?int $slow_mode_delay = null;

    /** @var int|null The time after which all messages sent to the chat will be automatically deleted; in seconds. Returned only in getChat. */
    public ?int $message_auto_delete_time = null;

    /** @var string|null For supergroups, name of group sticker set. Returned only in getChat. */
    public ?string $sticker_set_name = null;

    /** @var bool|null True, if the bot can change the group sticker set. Returned only in getChat. */
    public ?bool $can_set_sticker_set = null;

    /** @var int|null Unique identifier for the linked chat, i.e. the discussion group identifier for a channel and vice versa; for supergroups and channel chats. This identifier may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier. Returned only in getChat. */
    public ?int $linked_chat_id = null;

    /** @var ChatLocation|null For supergroups, the location to which the supergroup is connected. Returned only in getChat. */
    public ?ChatLocation $location = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->id = $array['id'];
        $this->type = $array['type'];
        $this->title = $array['title'] ?? null;
        $this->username = $array['username'] ?? null;
        $this->first_name = $array['first_name'] ?? null;
        $this->last_name = $array['last_name'] ?? null;
        $this->photo = isset($array['photo']) ? new ChatPhoto($array['photo'], $Bot) : null;
        $this->bio = $array['bio'] ?? null;
        $this->description = $array['description'] ?? null;
        $this->invite_link = $array['invite_link'] ?? null;
        $this->pinned_message = isset($array['pinned_message']) ? new Message($array['pinned_message'], $Bot) : null;
        $this->permissions = isset($array['permissions']) ? new ChatPermissions($array['permissions'], $Bot) : null;
        $this->slow_mode_delay = $array['slow_mode_delay'] ?? null;
        $this->message_auto_delete_time = $array['message_auto_delete_time'] ?? null;
        $this->sticker_set_name = $array['sticker_set_name'] ?? null;
        $this->can_set_sticker_set = $array['can_set_sticker_set'] ?? null;
        $this->linked_chat_id = $array['linked_chat_id'] ?? null;
        $this->location = isset($array['location']) ? new ChatLocation($array['location'], $Bot) : null;
        parent::__construct($array, $Bot);
   }
    
}
