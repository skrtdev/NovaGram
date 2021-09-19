<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\{Bot, conversations, dc};

/**
 * This object represents a Telegram user or bot.
*/
class User extends Type{
    
    use dc, conversations;

    /** @var int Unique identifier for this user or bot. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier. */
    public int $id;

    /** @var bool True, if this user is a bot */
    public bool $is_bot;

    /** @var string User's or bot's first name */
    public string $first_name;

    /** @var string|null User's or bot's last name */
    public ?string $last_name = null;

    /** @var string|null User's or bot's username */
    public ?string $username = null;

    /** @var string|null IETF language tag of the user's language */
    public ?string $language_code = null;

    /** @var bool|null True, if the bot can be invited to groups. Returned only in getMe. */
    public ?bool $can_join_groups = null;

    /** @var bool|null True, if privacy mode is disabled for the bot. Returned only in getMe. */
    public ?bool $can_read_all_group_messages = null;

    /** @var bool|null True, if the bot supports inline queries. Returned only in getMe. */
    public ?bool $supports_inline_queries = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->id = $array['id'];
        $this->is_bot = $array['is_bot'];
        $this->first_name = $array['first_name'];
        $this->last_name = $array['last_name'] ?? null;
        $this->username = $array['username'] ?? null;
        $this->language_code = $array['language_code'] ?? null;
        $this->can_join_groups = $array['can_join_groups'] ?? null;
        $this->can_read_all_group_messages = $array['can_read_all_group_messages'] ?? null;
        $this->supports_inline_queries = $array['supports_inline_queries'] ?? null;
        parent::__construct($array, $Bot);
    }

    public function getMention(): string
    {
        $this->Bot->settings->parse_mode ??= 'HTML';
        return "<a href=\"tg://user?id={$this->id}\">". htmlspecialchars($this->first_name. ( isset($this->last_name) ? " {$this->last_name}" : '' )) ."</a>";
    }

    public function sendMessage($text = null, $parse_mode = null, $entities = null, bool $disable_web_page_preview = null, bool $disable_notification = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, $reply_markup = null, bool $json_payload = false): ?Message
    {
        if(is_array($text)){
            $json_payload = $parse_mode ?? false;
            $params = $text;
        }
        else{
            if(is_bool($parse_mode)){
                $json_payload = $parse_mode;
                $params = ['text' => $text];
            }
            elseif(is_array($parse_mode)){
                $json_payload = $entities ?? false;
                $params = ['text' => $text] + $parse_mode;
            }
            else $params = ['text' => $text, 'parse_mode' => $parse_mode, 'entities' => $entities, 'disable_web_page_preview' => $disable_web_page_preview, 'disable_notification' => $disable_notification, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['user_id'] ??= $this->id;
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendMessage($params, $json_payload);
    }

    public function getProfilePhotos($offset = null, $limit = null, bool $json_payload = false): ?UserProfilePhotos
    {
        if(is_array($offset)){
            $json_payload = $limit ?? false;
            $params = $offset;
        }
        else{
            if(is_bool($limit)){
                $json_payload = $limit;
                $params = ['offset' => $offset];
            }
            elseif(is_array($limit)){
                $json_payload = $json_payload ?? false;
                $params = ['offset' => $offset] + $limit;
            }
            else $params = ['offset' => $offset, 'limit' => $limit, 'json_payload' => $json_payload];
        }
        $params['user_id'] ??= $this->id;
        return $this->Bot->getUserProfilePhotos($params, $json_payload);
    }

    public function banFromChat($chat_id = null, $until_date = null, $revoke_messages = null, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $until_date ?? false;
            $params = $chat_id;
        }
        else{
            if(is_bool($until_date)){
                $json_payload = $until_date;
                $params = ['chat_id' => $chat_id];
            }
            elseif(is_array($until_date)){
                $json_payload = $revoke_messages ?? false;
                $params = ['chat_id' => $chat_id] + $until_date;
            }
            else $params = ['chat_id' => $chat_id, 'until_date' => $until_date, 'revoke_messages' => $revoke_messages, 'json_payload' => $json_payload];
        }
        $params['user_id'] ??= $this->id;
        return $this->Bot->banChatMember($params, $json_payload);
    }

    public function unbanChatMember($chat_id = null, $only_if_banned = null, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $only_if_banned ?? false;
            $params = $chat_id;
        }
        else{
            if(is_bool($only_if_banned)){
                $json_payload = $only_if_banned;
                $params = ['chat_id' => $chat_id];
            }
            elseif(is_array($only_if_banned)){
                $json_payload = $json_payload ?? false;
                $params = ['chat_id' => $chat_id] + $only_if_banned;
            }
            else $params = ['chat_id' => $chat_id, 'only_if_banned' => $only_if_banned, 'json_payload' => $json_payload];
        }
        $params['user_id'] ??= $this->id;
        return $this->Bot->unbanChatMember($params, $json_payload);
    }

    public function restrictChatMember($chat_id = null, $permissions = null, $until_date = null, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $permissions ?? false;
            $params = $chat_id;
        }
        else{
            if(is_bool($permissions)){
                $json_payload = $permissions;
                $params = ['chat_id' => $chat_id];
            }
            elseif(is_array($permissions)){
                $json_payload = $until_date ?? false;
                $params = ['chat_id' => $chat_id] + $permissions;
            }
            else $params = ['chat_id' => $chat_id, 'permissions' => $permissions, 'until_date' => $until_date, 'json_payload' => $json_payload];
        }
        $params['user_id'] ??= $this->id;
        return $this->Bot->restrictChatMember($params, $json_payload);
    }

    public function promoteChatMember($chat_id = null, $is_anonymous = null, $can_manage_chat = null, bool $can_post_messages = null, bool $can_edit_messages = null, bool $can_delete_messages = null, bool $can_manage_voice_chats = null, bool $can_restrict_members = null, bool $can_promote_members = null, bool $can_change_info = null, bool $can_invite_users = null, bool $can_pin_messages = null, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $is_anonymous ?? false;
            $params = $chat_id;
        }
        else{
            if(is_bool($is_anonymous)){
                $json_payload = $is_anonymous;
                $params = ['chat_id' => $chat_id];
            }
            elseif(is_array($is_anonymous)){
                $json_payload = $can_manage_chat ?? false;
                $params = ['chat_id' => $chat_id] + $is_anonymous;
            }
            else $params = ['chat_id' => $chat_id, 'is_anonymous' => $is_anonymous, 'can_manage_chat' => $can_manage_chat, 'can_post_messages' => $can_post_messages, 'can_edit_messages' => $can_edit_messages, 'can_delete_messages' => $can_delete_messages, 'can_manage_voice_chats' => $can_manage_voice_chats, 'can_restrict_members' => $can_restrict_members, 'can_promote_members' => $can_promote_members, 'can_change_info' => $can_change_info, 'can_invite_users' => $can_invite_users, 'can_pin_messages' => $can_pin_messages, 'json_payload' => $json_payload];
        }
        $params['user_id'] ??= $this->id;
        return $this->Bot->promoteChatMember($params, $json_payload);
    }

    public function setChatAdministratorCustomTitle($chat_id = null, $custom_title = null, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $custom_title ?? false;
            $params = $chat_id;
        }
        else{
            if(is_bool($custom_title)){
                $json_payload = $custom_title;
                $params = ['chat_id' => $chat_id];
            }
            elseif(is_array($custom_title)){
                $json_payload = $json_payload ?? false;
                $params = ['chat_id' => $chat_id] + $custom_title;
            }
            else $params = ['chat_id' => $chat_id, 'custom_title' => $custom_title, 'json_payload' => $json_payload];
        }
        $params['user_id'] ??= $this->id;
        return $this->Bot->setChatAdministratorCustomTitle($params, $json_payload);
    }

    public function getChatMember($chat_id = null, bool $json_payload = false): ?ChatMember
    {
        if(is_array($chat_id)){
            $json_payload = $json_payload ?? false;
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'json_payload' => $json_payload];
        }
        $params['user_id'] ??= $this->id;
        return $this->Bot->getChatMember($params, $json_payload);
    }

    public function uploadStickerFile($png_sticker = null, bool $json_payload = false): ?File
    {
        if(is_array($png_sticker)){
            $json_payload = $json_payload ?? false;
            $params = $png_sticker;
        }
        else{
            $params = ['png_sticker' => $png_sticker, 'json_payload' => $json_payload];
        }
        $params['user_id'] ??= $this->id;
        return $this->Bot->uploadStickerFile($params, $json_payload);
    }

    public function createNewStickerSet($name = null, $title = null, $emojis = null, $png_sticker = null, $tgs_sticker = null, bool $contains_masks = null, array $mask_position = null, bool $json_payload = false): ?bool
    {
        if(is_array($name)){
            $json_payload = $title ?? false;
            $params = $name;
        }
        else{
            if(is_bool($title)){
                $json_payload = $title;
                $params = ['name' => $name];
            }
            elseif(is_array($title)){
                $json_payload = $emojis ?? false;
                $params = ['name' => $name] + $title;
            }
            else $params = ['name' => $name, 'title' => $title, 'emojis' => $emojis, 'png_sticker' => $png_sticker, 'tgs_sticker' => $tgs_sticker, 'contains_masks' => $contains_masks, 'mask_position' => $mask_position, 'json_payload' => $json_payload];
        }
        $params['user_id'] ??= $this->id;
        return $this->Bot->createNewStickerSet($params, $json_payload);
    }

    public function addStickerToSet($name = null, $emojis = null, $png_sticker = null, $tgs_sticker = null, array $mask_position = null, bool $json_payload = false): ?bool
    {
        if(is_array($name)){
            $json_payload = $emojis ?? false;
            $params = $name;
        }
        else{
            if(is_bool($emojis)){
                $json_payload = $emojis;
                $params = ['name' => $name];
            }
            elseif(is_array($emojis)){
                $json_payload = $png_sticker ?? false;
                $params = ['name' => $name] + $emojis;
            }
            else $params = ['name' => $name, 'emojis' => $emojis, 'png_sticker' => $png_sticker, 'tgs_sticker' => $tgs_sticker, 'mask_position' => $mask_position, 'json_payload' => $json_payload];
        }
        $params['user_id'] ??= $this->id;
        return $this->Bot->addStickerToSet($params, $json_payload);
    }

    public function setStickerSetThumb($name = null, $thumb = null, bool $json_payload = false): ?bool
    {
        if(is_array($name)){
            $json_payload = $thumb ?? false;
            $params = $name;
        }
        else{
            if(is_bool($thumb)){
                $json_payload = $thumb;
                $params = ['name' => $name];
            }
            elseif(is_array($thumb)){
                $json_payload = $json_payload ?? false;
                $params = ['name' => $name] + $thumb;
            }
            else $params = ['name' => $name, 'thumb' => $thumb, 'json_payload' => $json_payload];
        }
        $params['user_id'] ??= $this->id;
        return $this->Bot->setStickerSetThumb($params, $json_payload);
    }

    public function setGameScore($score = null, $force = null, $disable_edit_message = null, int $chat_id = null, int $message_id = null, string $inline_message_id = null, bool $json_payload = false)
    {
        if(is_array($score)){
            $json_payload = $force ?? false;
            $params = $score;
        }
        else{
            if(is_bool($force)){
                $json_payload = $force;
                $params = ['score' => $score];
            }
            elseif(is_array($force)){
                $json_payload = $disable_edit_message ?? false;
                $params = ['score' => $score] + $force;
            }
            else $params = ['score' => $score, 'force' => $force, 'disable_edit_message' => $disable_edit_message, 'chat_id' => $chat_id, 'message_id' => $message_id, 'inline_message_id' => $inline_message_id, 'json_payload' => $json_payload];
        }
        $params['user_id'] ??= $this->id;
        return $this->Bot->setGameScore($params, $json_payload);
    }
}
