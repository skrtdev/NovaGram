<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents a chat.
*/
class Chat extends \Telegram\Chat{

    /** @var int Unique identifier for this chat. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier. */
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

    /** @var string|null Description, for groups, supergroups and channel chats. Returned only in getChat. */
    public ?string $description = null;

    /** @var string|null Chat invite link, for groups, supergroups and channel chats. Each administrator in a chat generates their own invite links, so the bot must first generate the link using exportChatInviteLink. Returned only in getChat. */
    public ?string $invite_link = null;

    /** @var Message|null Pinned message, for groups, supergroups and channels. Returned only in getChat. */
    public ?Message $pinned_message = null;

    /** @var ChatPermissions|null Default chat member permissions, for groups and supergroups. Returned only in getChat. */
    public ?ChatPermissions $permissions = null;

    /** @var int|null For supergroups, the minimum allowed delay between consecutive messages sent by each unpriviledged user. Returned only in getChat. */
    public ?int $slow_mode_delay = null;

    /** @var string|null For supergroups, name of group sticker set. Returned only in getChat. */
    public ?string $sticker_set_name = null;

    /** @var bool|null True, if the bot can change the group sticker set. Returned only in getChat. */
    public ?bool $can_set_sticker_set = null;

    public function sendMessage($text = null, $args = null, bool $payload = false){
        if(is_array($text)){
            $payload = $args ?? false; // 2nd param
            $params = $text ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['text' => $text] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("sendMessage", $params, $payload);
    }

    public function forwardTo($from_chat_id = null, $args = null, bool $payload = false){
        if(is_array($from_chat_id)){
            $payload = $args ?? false; // 2nd param
            $params = $from_chat_id ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['from_chat_id' => $from_chat_id] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("forwardMessage", $params, $payload);
    }

    public function sendPhoto($photo = null, $args = null, bool $payload = false){
        if(is_array($photo)){
            $payload = $args ?? false; // 2nd param
            $params = $photo ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['photo' => $photo] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("sendPhoto", $params, $payload);
    }

    public function sendAudio($audio = null, $args = null, bool $payload = false){
        if(is_array($audio)){
            $payload = $args ?? false; // 2nd param
            $params = $audio ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['audio' => $audio] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("sendAudio", $params, $payload);
    }

    public function sendDocument($document = null, $args = null, bool $payload = false){
        if(is_array($document)){
            $payload = $args ?? false; // 2nd param
            $params = $document ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['document' => $document] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("sendDocument", $params, $payload);
    }

    public function sendVideo($video = null, $args = null, bool $payload = false){
        if(is_array($video)){
            $payload = $args ?? false; // 2nd param
            $params = $video ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['video' => $video] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("sendVideo", $params, $payload);
    }

    public function sendAnimation($animation = null, $args = null, bool $payload = false){
        if(is_array($animation)){
            $payload = $args ?? false; // 2nd param
            $params = $animation ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['animation' => $animation] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("sendAnimation", $params, $payload);
    }

    public function sendVoice($voice = null, $args = null, bool $payload = false){
        if(is_array($voice)){
            $payload = $args ?? false; // 2nd param
            $params = $voice ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['voice' => $voice] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("sendVoice", $params, $payload);
    }

    public function sendVideoNote($video_note = null, $args = null, bool $payload = false){
        if(is_array($video_note)){
            $payload = $args ?? false; // 2nd param
            $params = $video_note ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['video_note' => $video_note] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("sendVideoNote", $params, $payload);
    }

    public function sendMediaGroup($media = null, $args = null, bool $payload = false){
        if(is_array($media)){
            $payload = $args ?? false; // 2nd param
            $params = $media ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['media' => $media] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("sendMediaGroup", $params, $payload);
    }

    public function sendLocation($latitude = null, $args = null, bool $payload = false){
        if(is_array($latitude)){
            $payload = $args ?? false; // 2nd param
            $params = $latitude ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['latitude' => $latitude] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("sendLocation", $params, $payload);
    }

    public function editMessageLiveLocation($message_id = null, $args = null, bool $payload = false){
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
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("editMessageLiveLocation", $params, $payload);
    }

    public function stopMessageLiveLocation($message_id = null, $args = null, bool $payload = false){
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
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("stopMessageLiveLocation", $params, $payload);
    }

    public function sendVenue($latitude = null, $args = null, bool $payload = false){
        if(is_array($latitude)){
            $payload = $args ?? false; // 2nd param
            $params = $latitude ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['latitude' => $latitude] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("sendVenue", $params, $payload);
    }

    public function sendContact($phone_number = null, $args = null, bool $payload = false){
        if(is_array($phone_number)){
            $payload = $args ?? false; // 2nd param
            $params = $phone_number ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['phone_number' => $phone_number] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("sendContact", $params, $payload);
    }

    public function sendPoll($question = null, $args = null, bool $payload = false){
        if(is_array($question)){
            $payload = $args ?? false; // 2nd param
            $params = $question ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['question' => $question] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("sendPoll", $params, $payload);
    }

    public function sendDice($emoji = null, $args = null, bool $payload = false){
        if(is_array($emoji)){
            $payload = $args ?? false; // 2nd param
            $params = $emoji ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['emoji' => $emoji] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("sendDice", $params, $payload);
    }

    public function sendAction($action = null, bool $payload = false){
        $params = [];
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("sendChatAction", $params, $payload);
    }

    public function kickMember($user_id = null, $args = null, bool $payload = false){
        if(is_array($user_id)){
            $payload = $args ?? false; // 2nd param
            $params = $user_id ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['user_id' => $user_id] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("kickChatMember", $params, $payload);
    }

    public function unbanMember($user_id = null, bool $payload = false){
        $params = [];
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("unbanChatMember", $params, $payload);
    }

    public function restrictMember($user_id = null, $args = null, bool $payload = false){
        if(is_array($user_id)){
            $payload = $args ?? false; // 2nd param
            $params = $user_id ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['user_id' => $user_id] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("restrictChatMember", $params, $payload);
    }

    public function promoteMember($user_id = null, $args = null, bool $payload = false){
        if(is_array($user_id)){
            $payload = $args ?? false; // 2nd param
            $params = $user_id ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['user_id' => $user_id] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("promoteChatMember", $params, $payload);
    }

    public function setAdministratorCustomTitle($user_id = null, $args = null, bool $payload = false){
        if(is_array($user_id)){
            $payload = $args ?? false; // 2nd param
            $params = $user_id ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['user_id' => $user_id] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("setChatAdministratorCustomTitle", $params, $payload);
    }

    public function setPermissions($permissions = null, bool $payload = false){
        $params = [];
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("setChatPermissions", $params, $payload);
    }

    public function exportInviteLink(bool $payload = false){
        $params = [];
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("exportChatInviteLink", $params, $payload);
    }

    public function setPhoto($photo = null, bool $payload = false){
        $params = [];
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("setChatPhoto", $params, $payload);
    }

    public function deletePhoto(bool $payload = false){
        $params = [];
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("deleteChatPhoto", $params, $payload);
    }

    public function setTitle($title = null, bool $payload = false){
        $params = [];
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("setChatTitle", $params, $payload);
    }

    public function setDescription($description = null, bool $payload = false){
        $params = [];
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("setChatDescription", $params, $payload);
    }

    public function pinMessage($message_id = null, $args = null, bool $payload = false){
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
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("pinChatMessage", $params, $payload);
    }

    public function unpinMessage(bool $payload = false){
        $params = [];
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("unpinChatMessage", $params, $payload);
    }

    public function leave(bool $payload = false){
        $params = [];
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("leaveChat", $params, $payload);
    }

    public function get(bool $payload = false){
        $params = [];
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("getChat", $params, $payload);
    }

    public function getAdministrators(bool $payload = false){
        $params = [];
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("getChatAdministrators", $params, $payload);
    }

    public function getMembersCount(bool $payload = false){
        $params = [];
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("getChatMembersCount", $params, $payload);
    }

    public function getMember($user_id = null, bool $payload = false){
        $params = [];
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("getChatMember", $params, $payload);
    }

    public function setStickerSet($sticker_set_name = null, bool $payload = false){
        $params = [];
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("setChatStickerSet", $params, $payload);
    }

    public function deleteStickerSet(bool $payload = false){
        $params = [];
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("deleteChatStickerSet", $params, $payload);
    }

    public function editMessageText($message_id = null, $args = null, bool $payload = false){
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
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("editMessageText", $params, $payload);
    }

    public function editMessageCaption($message_id = null, $args = null, bool $payload = false){
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
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("editMessageCaption", $params, $payload);
    }

    public function editMessageMedia($message_id = null, $args = null, bool $payload = false){
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
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("editMessageMedia", $params, $payload);
    }

    public function editMessageReplyMarkup($message_id = null, $args = null, bool $payload = false){
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
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("editMessageReplyMarkup", $params, $payload);
    }

    public function stopPoll($message_id = null, bool $payload = false){
        $params = [];
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("stopPoll", $params, $payload);
    }

    public function setGameScore($user_id = null, $args = null, bool $payload = false){
        if(is_array($user_id)){
            $payload = $args ?? false; // 2nd param
            $params = $user_id ?? [];
        }
        else{
            if(is_bool($args)){
                $payload = $args;
                $args = [];
            }
            $params = ['user_id' => $user_id] + ($args ?? []);
        }
        $params['chat_id'] ??= $this->presetToValue('id');
        return $this->Bot->APICall("setGameScore", $params, $payload);
    }
}

?>
