<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Describes actions that a non-administrator user is allowed to take in a chat.
*/
class ChatPermissions extends Type{
    
    /** @var bool|null True, if the user is allowed to send text messages, contacts, locations and venues */
    public ?bool $can_send_messages = null;

    /** @var bool|null True, if the user is allowed to send audios, documents, photos, videos, video notes and voice notes, implies can_send_messages */
    public ?bool $can_send_media_messages = null;

    /** @var bool|null True, if the user is allowed to send polls, implies can_send_messages */
    public ?bool $can_send_polls = null;

    /** @var bool|null True, if the user is allowed to send animations, games, stickers and use inline bots, implies can_send_media_messages */
    public ?bool $can_send_other_messages = null;

    /** @var bool|null True, if the user is allowed to add web page previews to their messages, implies can_send_media_messages */
    public ?bool $can_add_web_page_previews = null;

    /** @var bool|null True, if the user is allowed to change the chat title, photo and other settings. Ignored in public supergroups */
    public ?bool $can_change_info = null;

    /** @var bool|null True, if the user is allowed to invite new users to the chat */
    public ?bool $can_invite_users = null;

    /** @var bool|null True, if the user is allowed to pin messages. Ignored in public supergroups */
    public ?bool $can_pin_messages = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->can_send_messages = $array['can_send_messages'] ?? null;
        $this->can_send_media_messages = $array['can_send_media_messages'] ?? null;
        $this->can_send_polls = $array['can_send_polls'] ?? null;
        $this->can_send_other_messages = $array['can_send_other_messages'] ?? null;
        $this->can_add_web_page_previews = $array['can_add_web_page_previews'] ?? null;
        $this->can_change_info = $array['can_change_info'] ?? null;
        $this->can_invite_users = $array['can_invite_users'] ?? null;
        $this->can_pin_messages = $array['can_pin_messages'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
