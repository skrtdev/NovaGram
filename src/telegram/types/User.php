<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents a Telegram user or bot.
*/
class User extends \Telegram\User{

    /** @var int Unique identifier for this user or bot */
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

    public function getProfilePhotos($offset = null, $args = null, bool $payload = false){
        if(is_array($offset)){
            $payload = $args ?? false; // 2nd param
            $params = $offset ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['offset' => $offset] + ($args ?? []);
        }
        $params['user_id'] ??= $this->presetToValue('id');
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("getUserProfilePhotos", $params, $payload);
    }

    public function kickChatMember($until_date = null, $args = null, bool $payload = false){
        if(is_array($until_date)){
            $payload = $args ?? false; // 2nd param
            $params = $until_date ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['until_date' => $until_date] + ($args ?? []);
        }
        $params['user_id'] ??= $this->presetToValue('id');
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("kickChatMember", $params, $payload);
    }

    public function unbanChatMember(bool $payload = false){
        $params = [];
        $params['user_id'] ??= $this->presetToValue('id');
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("unbanChatMember", $params, $payload);
    }

    public function restrictChatMember($permissions = null, $args = null, bool $payload = false){
        if(is_array($permissions)){
            $payload = $args ?? false; // 2nd param
            $params = $permissions ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['permissions' => $permissions] + ($args ?? []);
        }
        $params['user_id'] ??= $this->presetToValue('id');
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("restrictChatMember", $params, $payload);
    }

    public function promoteChatMember($can_change_info = null, $args = null, bool $payload = false){
        if(is_array($can_change_info)){
            $payload = $args ?? false; // 2nd param
            $params = $can_change_info ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['can_change_info' => $can_change_info] + ($args ?? []);
        }
        $params['user_id'] ??= $this->presetToValue('id');
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("promoteChatMember", $params, $payload);
    }

    public function setChatAdministratorCustomTitle($custom_title = null, $args = null, bool $payload = false){
        if(is_array($custom_title)){
            $payload = $args ?? false; // 2nd param
            $params = $custom_title ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['custom_title' => $custom_title] + ($args ?? []);
        }
        $params['user_id'] ??= $this->presetToValue('id');
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("setChatAdministratorCustomTitle", $params, $payload);
    }

    public function getChatMember(bool $payload = false){
        $params = [];
        $params['user_id'] ??= $this->presetToValue('id');
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("getChatMember", $params, $payload);
    }

    public function getStickerSet($png_sticker = null, bool $payload = false){
        $params = [];
        $params['user_id'] ??= $this->presetToValue('id');
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("getStickerSet", $params, $payload);
    }

    public function uploadStickerFile($name = null, $args = null, bool $payload = false){
        if(is_array($name)){
            $payload = $args ?? false; // 2nd param
            $params = $name ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['name' => $name] + ($args ?? []);
        }
        $params['user_id'] ??= $this->presetToValue('id');
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("uploadStickerFile", $params, $payload);
    }

    public function createNewStickerSet($name = null, $args = null, bool $payload = false){
        if(is_array($name)){
            $payload = $args ?? false; // 2nd param
            $params = $name ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['name' => $name] + ($args ?? []);
        }
        $params['user_id'] ??= $this->presetToValue('id');
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("createNewStickerSet", $params, $payload);
    }

    public function deleteStickerFromSet($name = null, $args = null, bool $payload = false){
        if(is_array($name)){
            $payload = $args ?? false; // 2nd param
            $params = $name ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['name' => $name] + ($args ?? []);
        }
        $params['user_id'] ??= $this->presetToValue('id');
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("deleteStickerFromSet", $params, $payload);
    }

    public function setGameScore($message_id = null, $args = null, bool $payload = false){
        if(is_array($message_id)){
            $payload = $args ?? false; // 2nd param
            $params = $message_id ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['message_id' => $message_id] + ($args ?? []);
        }
        $params['user_id'] ??= $this->presetToValue('id');
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("setGameScore", $params, $payload);
    }
}

?>
