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
                $args = null;
            }
            $params = ['offset' => $offset] + ($args ?? []);
        }
        $params['user_id'] = $this->presetToValue('id');
        return $this->Bot->APICall("getUserProfilePhotos", $params, $payload);
    }

    public function kickChatMember($chat_id = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $args ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = null;
            }
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        $params['user_id'] = $this->presetToValue('id');
        return $this->Bot->APICall("kickChatMember", $params, $payload);
    }

    public function unbanChatMember($chat_id = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = null;
            }
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        $params['user_id'] = $this->presetToValue('id');
        return $this->Bot->APICall("unbanChatMember", $params, $payload);
    }

    public function restrictChatMember($chat_id = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $args ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = null;
            }
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        $params['user_id'] = $this->presetToValue('id');
        return $this->Bot->APICall("restrictChatMember", $params, $payload);
    }

    public function promoteChatMember($chat_id = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $args ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = null;
            }
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        $params['user_id'] = $this->presetToValue('id');
        return $this->Bot->APICall("promoteChatMember", $params, $payload);
    }

    public function setChatAdministratorCustomTitle($chat_id = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $args ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = null;
            }
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        $params['user_id'] = $this->presetToValue('id');
        return $this->Bot->APICall("setChatAdministratorCustomTitle", $params, $payload);
    }

    public function getChatMember($chat_id = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = null;
            }
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        $params['user_id'] = $this->presetToValue('id');
        return $this->Bot->APICall("getChatMember", $params, $payload);
    }

    public function getStickerSet($png_sticker = null, bool $payload = false){
        if(is_array($png_sticker)){
            $payload = $payload ?? false; // 2nd param
            $params = $png_sticker ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = null;
            }
            $params = ['png_sticker' => $png_sticker] + ($args ?? []);
        }
        $params['user_id'] = $this->presetToValue('id');
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
                $args = null;
            }
            $params = ['name' => $name] + ($args ?? []);
        }
        $params['user_id'] = $this->presetToValue('id');
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
                $args = null;
            }
            $params = ['name' => $name] + ($args ?? []);
        }
        $params['user_id'] = $this->presetToValue('id');
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
                $args = null;
            }
            $params = ['name' => $name] + ($args ?? []);
        }
        $params['user_id'] = $this->presetToValue('id');
        return $this->Bot->APICall("deleteStickerFromSet", $params, $payload);
    }

    public function setGameScore($chat_id = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $args ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = null;
            }
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        $params['user_id'] = $this->presetToValue('id');
        return $this->Bot->APICall("setGameScore", $params, $payload);
    }
}

?>
