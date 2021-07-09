<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object contains information about one member of a chat.
*/
class ChatMember extends Type{

    /** @var User Information about the user */
    public User $user;

    /** @var string The member's status in the chat. Can be “creator”, “administrator”, “member”, “restricted”, “left” or “kicked” */
    public string $status;

    /** @var string|null Owner and administrators only. Custom title for this user */
    public ?string $custom_title = null;

    /** @var bool|null Owner and administrators only. True, if the user's presence in the chat is hidden */
    public ?bool $is_anonymous = null;

    /** @var bool|null Administrators only. True, if the bot is allowed to edit administrator privileges of that user */
    public ?bool $can_be_edited = null;

    /** @var bool|null Administrators only. True, if the administrator can access the chat event log, chat statistics, message statistics in channels, see channel members, see anonymous administrators in supergroups and ignore slow mode. Implied by any other administrator privilege */
    public ?bool $can_manage_chat = null;

    /** @var bool|null Administrators only. True, if the administrator can post in the channel; channels only */
    public ?bool $can_post_messages = null;

    /** @var bool|null Administrators only. True, if the administrator can edit messages of other users and can pin messages; channels only */
    public ?bool $can_edit_messages = null;

    /** @var bool|null Administrators only. True, if the administrator can delete messages of other users */
    public ?bool $can_delete_messages = null;

    /** @var bool|null Administrators only. True, if the administrator can manage voice chats */
    public ?bool $can_manage_voice_chats = null;

    /** @var bool|null Administrators only. True, if the administrator can restrict, ban or unban chat members */
    public ?bool $can_restrict_members = null;

    /** @var bool|null Administrators only. True, if the administrator can add new administrators with a subset of their own privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by the user) */
    public ?bool $can_promote_members = null;

    /** @var bool|null Administrators and restricted only. True, if the user is allowed to change the chat title, photo and other settings */
    public ?bool $can_change_info = null;

    /** @var bool|null Administrators and restricted only. True, if the user is allowed to invite new users to the chat */
    public ?bool $can_invite_users = null;

    /** @var bool|null Administrators and restricted only. True, if the user is allowed to pin messages; groups and supergroups only */
    public ?bool $can_pin_messages = null;

    /** @var bool|null Restricted only. True, if the user is a member of the chat at the moment of the request */
    public ?bool $is_member = null;

    /** @var bool|null Restricted only. True, if the user is allowed to send text messages, contacts, locations and venues */
    public ?bool $can_send_messages = null;

    /** @var bool|null Restricted only. True, if the user is allowed to send audios, documents, photos, videos, video notes and voice notes */
    public ?bool $can_send_media_messages = null;

    /** @var bool|null Restricted only. True, if the user is allowed to send polls */
    public ?bool $can_send_polls = null;

    /** @var bool|null Restricted only. True, if the user is allowed to send animations, games, stickers and use inline bots */
    public ?bool $can_send_other_messages = null;

    /** @var bool|null Restricted only. True, if the user is allowed to add web page previews to their messages */
    public ?bool $can_add_web_page_previews = null;

    /** @var int|null Restricted and kicked only. Date when restrictions will be lifted for this user; unix time */
    public ?int $until_date = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->user = new User($array['user'], $Bot);
        $this->status = $array['status'];
        $this->custom_title = $array['custom_title'] ?? null;
        $this->is_anonymous = $array['is_anonymous'] ?? null;
        $this->can_be_edited = $array['can_be_edited'] ?? null;
        $this->can_manage_chat = $array['can_manage_chat'] ?? null;
        $this->can_post_messages = $array['can_post_messages'] ?? null;
        $this->can_edit_messages = $array['can_edit_messages'] ?? null;
        $this->can_delete_messages = $array['can_delete_messages'] ?? null;
        $this->can_manage_voice_chats = $array['can_manage_voice_chats'] ?? null;
        $this->can_restrict_members = $array['can_restrict_members'] ?? null;
        $this->can_promote_members = $array['can_promote_members'] ?? null;
        $this->can_change_info = $array['can_change_info'] ?? null;
        $this->can_invite_users = $array['can_invite_users'] ?? null;
        $this->can_pin_messages = $array['can_pin_messages'] ?? null;
        $this->is_member = $array['is_member'] ?? null;
        $this->can_send_messages = $array['can_send_messages'] ?? null;
        $this->can_send_media_messages = $array['can_send_media_messages'] ?? null;
        $this->can_send_polls = $array['can_send_polls'] ?? null;
        $this->can_send_other_messages = $array['can_send_other_messages'] ?? null;
        $this->can_add_web_page_previews = $array['can_add_web_page_previews'] ?? null;
        $this->until_date = $array['until_date'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
