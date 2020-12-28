<?php

namespace skrtdev\NovaGram;

trait Methods{

    /**
     * Use this method to receive incoming updates using long polling (wiki).
     * An Array of Update objects is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Update[]
     */
    public function getUpdates($args = null, bool $json_payload = false, ...$kwargs){
        $params = $args;
        return $this->APICall("getUpdates", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to specify a url and receive incoming updates via an outgoing webhook.
     * Whenever there is an update for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update.
     * In case of an unsuccessful request, we will give up after a reasonable amount of attempts.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function setWebhook($url, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($url)){
            $json_payload = $args ?? false; // 2nd param
            $params = $url ?? [];
        }
        else{
            $params = ["url" => $url] + ($args ?? []);
        }
        return $this->APICall("setWebhook", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to remove webhook integration if you decide to switch back to getUpdates.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function deleteWebhook($args = null, bool $json_payload = false, ...$kwargs){
        $params = $args;
        return $this->APICall("deleteWebhook", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to get current webhook status.
     * Requires no parameters.
     * On success, returns a WebhookInfo object.
     * If the bot is using getUpdates, will return an object with the url field empty.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\WebhookInfo
     */
    public function getWebhookInfo(bool $json_payload = false){
        return $this->APICall("getWebhookInfo", $params ?? [], $json_payload);
    }

    /**
     * A simple method for testing your bot's auth token.
     * Requires no parameters.
     * Returns basic information about the bot in form of a User object.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\User
     */
    public function getMe(bool $json_payload = false){
        return $this->APICall("getMe", $params ?? [], $json_payload);
    }

    /**
     * Use this method to log out from the cloud Bot API server before launching the bot locally.
     * You must log out the bot before running it locally, otherwise there is no guarantee that the bot will receive updates.
     * After a successful call, you can immediately log in on a local server, but will not be able to log in back to the cloud Bot API server for 10 minutes.
     * Returns True on success.
     * Requires no parameters.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function logOut(bool $json_payload = false){
        return $this->APICall("logOut", $params ?? [], $json_payload);
    }

    /**
     * Use this method to close the bot instance before moving it from one local server to another.
     * You need to delete the webhook before calling this method to ensure that the bot isn't launched again after server restart.
     * The method will return error 429 in the first 10 minutes after the bot is launched.
     * Returns True on success.
     * Requires no parameters.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function close(bool $json_payload = false){
        return $this->APICall("close", $params ?? [], $json_payload);
    }

    /**
     * Use this method to send text messages.
     * On success, the sent Message is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message
     */
    public function sendMessage($chat_id, $text = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $text ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "text" => $text] + ($args ?? []);
        }
        return $this->APICall("sendMessage", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to forward messages of any kind.
     * On success, the sent Message is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message
     */
    public function forwardMessage($chat_id, $from_chat_id = null, int $message_id = null, array $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $from_chat_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "from_chat_id" => $from_chat_id, "message_id" => $message_id] + ($args ?? []);
        }
        return $this->APICall("forwardMessage", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to copy messages of any kind.
     * The method is analogous to the method forwardMessages, but the copied message doesn't have a link to the original message.
     * Returns the MessageId of the sent message on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\MessageId
     */
    public function copyMessage($chat_id, $from_chat_id = null, int $message_id = null, array $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $from_chat_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "from_chat_id" => $from_chat_id, "message_id" => $message_id] + ($args ?? []);
        }
        return $this->APICall("copyMessage", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to send photos.
     * On success, the sent Message is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message
     */
    public function sendPhoto($chat_id, $photo = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $photo ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "photo" => $photo] + ($args ?? []);
        }
        return $this->APICall("sendPhoto", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player.
     * Your audio must be in the .MP3 or .M4A format.
     * On success, the sent Message is returned.
     * Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message
     */
    public function sendAudio($chat_id, $audio = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $audio ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "audio" => $audio] + ($args ?? []);
        }
        return $this->APICall("sendAudio", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to send general files.
     * On success, the sent Message is returned.
     * Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message
     */
    public function sendDocument($chat_id, $document = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $document ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "document" => $document] + ($args ?? []);
        }
        return $this->APICall("sendDocument", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as Document).
     * On success, the sent Message is returned.
     * Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message
     */
    public function sendVideo($chat_id, $video = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $video ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "video" => $video] + ($args ?? []);
        }
        return $this->APICall("sendVideo", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound).
     * On success, the sent Message is returned.
     * Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message
     */
    public function sendAnimation($chat_id, $animation = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $animation ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "animation" => $animation] + ($args ?? []);
        }
        return $this->APICall("sendAnimation", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message.
     * For this to work, your audio must be in an .OGG file encoded with OPUS (other formats may be sent as Audio or Document).
     * On success, the sent Message is returned.
     * Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message
     */
    public function sendVoice($chat_id, $voice = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $voice ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "voice" => $voice] + ($args ?? []);
        }
        return $this->APICall("sendVoice", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * As of v.4.0, Telegram clients support rounded square mp4 videos of up to 1 minute long.
     * Use this method to send video messages.
     * On success, the sent Message is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message
     */
    public function sendVideoNote($chat_id, $video_note = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $video_note ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "video_note" => $video_note] + ($args ?? []);
        }
        return $this->APICall("sendVideoNote", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to send a group of photos, videos, documents or audios as an album.
     * Documents and audio files can be only group in an album with messages of the same type.
     * On success, an array of Messages that were sent is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message[]
     */
    public function sendMediaGroup($chat_id, $media = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $media ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "media" => $media] + ($args ?? []);
        }
        return $this->APICall("sendMediaGroup", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to send point on the map.
     * On success, the sent Message is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message
     */
    public function sendLocation($chat_id, $latitude = null, float $longitude = null, array $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $latitude ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "latitude" => $latitude, "longitude" => $longitude] + ($args ?? []);
        }
        return $this->APICall("sendLocation", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to edit live location messages.
     * A location can be edited until its live_period expires or editing is explicitly disabled by a call to stopMessageLiveLocation.
     * On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message|bool
     */
    public function editMessageLiveLocation($latitude, $longitude = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($latitude)){
            $json_payload = $longitude ?? false; // 2nd param
            $params = $latitude ?? [];
        }
        else{
            $params = ["latitude" => $latitude, "longitude" => $longitude] + ($args ?? []);
        }
        return $this->APICall("editMessageLiveLocation", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to stop updating a live location message before live_period expires.
     * On success, if the message was sent by the bot, the sent Message is returned, otherwise True is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message|bool
     */
    public function stopMessageLiveLocation($args = null, bool $json_payload = false, ...$kwargs){
        $params = $args;
        return $this->APICall("stopMessageLiveLocation", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to send information about a venue.
     * On success, the sent Message is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message
     */
    public function sendVenue($chat_id, $latitude = null, float $longitude = null, string $title = null, string $address = null, array $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $latitude ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "latitude" => $latitude, "longitude" => $longitude, "title" => $title, "address" => $address] + ($args ?? []);
        }
        return $this->APICall("sendVenue", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to send phone contacts.
     * On success, the sent Message is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message
     */
    public function sendContact($chat_id, $phone_number = null, string $first_name = null, array $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $phone_number ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "phone_number" => $phone_number, "first_name" => $first_name] + ($args ?? []);
        }
        return $this->APICall("sendContact", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to send a native poll.
     * On success, the sent Message is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message
     */
    public function sendPoll($chat_id, $question = null, array $options = null, array $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $question ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "question" => $question, "options" => $options] + ($args ?? []);
        }
        return $this->APICall("sendPoll", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to send an animated emoji that will display a random value.
     * On success, the sent Message is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message
     */
    public function sendDice($chat_id, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $args ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("sendDice", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method when you need to tell the user that something is happening on the bot's side.
     * The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status).
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function sendChatAction($chat_id, $action = null, bool $json_payload = false){
        if(is_array($chat_id)){
            $json_payload = $action ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "action" => $action] + ($args ?? []);
        }
        return $this->APICall("sendChatAction", $params ?? [], $json_payload);
    }

    /**
     * Use this method to get a list of profile pictures for a user.
     * Returns a UserProfilePhotos object.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\UserProfilePhotos
     */
    public function getUserProfilePhotos($user_id, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($user_id)){
            $json_payload = $args ?? false; // 2nd param
            $params = $user_id ?? [];
        }
        else{
            $params = ["user_id" => $user_id] + ($args ?? []);
        }
        return $this->APICall("getUserProfilePhotos", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to get basic info about a file and prepare it for downloading.
     * For the moment, bots can download files of up to 20MB in size.
     * On success, a File object is returned.
     * The file can then be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>, where <file_path> is taken from the response.
     * It is guaranteed that the link will be valid for at least 1 hour.
     * When the link expires, a new one can be requested by calling getFile again.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\File
     */
    public function getFile($file_id, bool $json_payload = false){
        if(is_array($file_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $file_id ?? [];
        }
        else{
            $params = ["file_id" => $file_id] + ($args ?? []);
        }
        return $this->APICall("getFile", $params ?? [], $json_payload);
    }

    /**
     * Use this method to kick a user from a group, a supergroup or a channel.
     * In the case of supergroups and channels, the user will not be able to return to the group on their own using invite links, etc., unless unbanned first.
     * The bot must be an administrator in the chat for this to work and must have the appropriate admin rights.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function kickChatMember($chat_id, $user_id = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $user_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "user_id" => $user_id] + ($args ?? []);
        }
        return $this->APICall("kickChatMember", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to unban a previously kicked user in a supergroup or channel.
     * The user will not return to the group or channel automatically, but will be able to join via link, etc.
     * The bot must be an administrator for this to work.
     * By default, this method guarantees that after the call the user is not a member of the chat, but will be able to join it.
     * So if the user is a member of the chat they will also be removed from the chat.
     * If you don't want this, use the parameter only_if_banned.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function unbanChatMember($chat_id, $user_id = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $user_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "user_id" => $user_id] + ($args ?? []);
        }
        return $this->APICall("unbanChatMember", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to restrict a user in a supergroup.
     * The bot must be an administrator in the supergroup for this to work and must have the appropriate admin rights.
     * Pass True for all permissions to lift restrictions from a user.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function restrictChatMember($chat_id, $user_id = null, ChatPermissions $permissions = null, array $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $user_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "user_id" => $user_id, "permissions" => $permissions] + ($args ?? []);
        }
        return $this->APICall("restrictChatMember", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to promote or demote a user in a supergroup or a channel.
     * The bot must be an administrator in the chat for this to work and must have the appropriate admin rights.
     * Pass False for all boolean parameters to demote a user.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function promoteChatMember($chat_id, $user_id = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $user_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "user_id" => $user_id] + ($args ?? []);
        }
        return $this->APICall("promoteChatMember", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to set a custom title for an administrator in a supergroup promoted by the bot.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function setChatAdministratorCustomTitle($chat_id, $user_id = null, string $custom_title = null, bool $json_payload = false){
        if(is_array($chat_id)){
            $json_payload = $user_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "user_id" => $user_id, "custom_title" => $custom_title] + ($args ?? []);
        }
        return $this->APICall("setChatAdministratorCustomTitle", $params ?? [], $json_payload);
    }

    /**
     * Use this method to set default chat permissions for all members.
     * The bot must be an administrator in the group or a supergroup for this to work and must have the can_restrict_members admin rights.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function setChatPermissions($chat_id, $permissions = null, bool $json_payload = false){
        if(is_array($chat_id)){
            $json_payload = $permissions ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "permissions" => $permissions] + ($args ?? []);
        }
        return $this->APICall("setChatPermissions", $params ?? [], $json_payload);
    }

    /**
     * Use this method to generate a new invite link for a chat; any previously generated link is revoked.
     * The bot must be an administrator in the chat for this to work and must have the appropriate admin rights.
     * Returns the new invite link as String on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return string
     */
    public function exportChatInviteLink($chat_id, bool $json_payload = false){
        if(is_array($chat_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("exportChatInviteLink", $params ?? [], $json_payload);
    }

    /**
     * Use this method to set a new profile photo for the chat.
     * Photos can't be changed for private chats.
     * The bot must be an administrator in the chat for this to work and must have the appropriate admin rights.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function setChatPhoto($chat_id, $photo = null, bool $json_payload = false){
        if(is_array($chat_id)){
            $json_payload = $photo ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "photo" => $photo] + ($args ?? []);
        }
        return $this->APICall("setChatPhoto", $params ?? [], $json_payload);
    }

    /**
     * Use this method to delete a chat photo.
     * Photos can't be changed for private chats.
     * The bot must be an administrator in the chat for this to work and must have the appropriate admin rights.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function deleteChatPhoto($chat_id, bool $json_payload = false){
        if(is_array($chat_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("deleteChatPhoto", $params ?? [], $json_payload);
    }

    /**
     * Use this method to change the title of a chat.
     * Titles can't be changed for private chats.
     * The bot must be an administrator in the chat for this to work and must have the appropriate admin rights.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function setChatTitle($chat_id, $title = null, bool $json_payload = false){
        if(is_array($chat_id)){
            $json_payload = $title ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "title" => $title] + ($args ?? []);
        }
        return $this->APICall("setChatTitle", $params ?? [], $json_payload);
    }

    /**
     * Use this method to change the description of a group, a supergroup or a channel.
     * The bot must be an administrator in the chat for this to work and must have the appropriate admin rights.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function setChatDescription($chat_id, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $args ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("setChatDescription", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to add a message to the list of pinned messages in a chat.
     * If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' admin right in a supergroup or 'can_edit_messages' admin right in a channel.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function pinChatMessage($chat_id, $message_id = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $message_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "message_id" => $message_id] + ($args ?? []);
        }
        return $this->APICall("pinChatMessage", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to remove a message from the list of pinned messages in a chat.
     * If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' admin right in a supergroup or 'can_edit_messages' admin right in a channel.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function unpinChatMessage($chat_id, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $args ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("unpinChatMessage", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to clear the list of pinned messages in a chat.
     * If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' admin right in a supergroup or 'can_edit_messages' admin right in a channel.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function unpinAllChatMessages($chat_id, bool $json_payload = false){
        if(is_array($chat_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("unpinAllChatMessages", $params ?? [], $json_payload);
    }

    /**
     * Use this method for your bot to leave a group, supergroup or channel.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function leaveChat($chat_id, bool $json_payload = false){
        if(is_array($chat_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("leaveChat", $params ?? [], $json_payload);
    }

    /**
     * Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.).
     * Returns a Chat object on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Chat
     */
    public function getChat($chat_id, bool $json_payload = false){
        if(is_array($chat_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("getChat", $params ?? [], $json_payload);
    }

    /**
     * Use this method to get a list of administrators in a chat.
     * On success, returns an Array of ChatMember objects that contains information about all chat administrators except other bots.
     * If the chat is a group or a supergroup and no administrators were appointed, only the creator will be returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\ChatMember[]
     */
    public function getChatAdministrators($chat_id, bool $json_payload = false){
        if(is_array($chat_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("getChatAdministrators", $params ?? [], $json_payload);
    }

    /**
     * Use this method to get the number of members in a chat.
     * Returns Int on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return int
     */
    public function getChatMembersCount($chat_id, bool $json_payload = false){
        if(is_array($chat_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("getChatMembersCount", $params ?? [], $json_payload);
    }

    /**
     * Use this method to get information about a member of a chat.
     * Returns a ChatMember object on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\ChatMember
     */
    public function getChatMember($chat_id, $user_id = null, bool $json_payload = false){
        if(is_array($chat_id)){
            $json_payload = $user_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "user_id" => $user_id] + ($args ?? []);
        }
        return $this->APICall("getChatMember", $params ?? [], $json_payload);
    }

    /**
     * Use this method to set a new group sticker set for a supergroup.
     * The bot must be an administrator in the chat for this to work and must have the appropriate admin rights.
     * Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function setChatStickerSet($chat_id, $sticker_set_name = null, bool $json_payload = false){
        if(is_array($chat_id)){
            $json_payload = $sticker_set_name ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "sticker_set_name" => $sticker_set_name] + ($args ?? []);
        }
        return $this->APICall("setChatStickerSet", $params ?? [], $json_payload);
    }

    /**
     * Use this method to delete a group sticker set from a supergroup.
     * The bot must be an administrator in the chat for this to work and must have the appropriate admin rights.
     * Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function deleteChatStickerSet($chat_id, bool $json_payload = false){
        if(is_array($chat_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("deleteChatStickerSet", $params ?? [], $json_payload);
    }

    /**
     * Use this method to send answers to callback queries sent from inline keyboards.
     * The answer will be displayed to the user as a notification at the top of the chat screen or as an alert.
     * On success, True is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function answerCallbackQuery($callback_query_id, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($callback_query_id)){
            $json_payload = $args ?? false; // 2nd param
            $params = $callback_query_id ?? [];
        }
        else{
            $params = ["callback_query_id" => $callback_query_id] + ($args ?? []);
        }
        return $this->APICall("answerCallbackQuery", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to change the list of the bot's commands.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function setMyCommands($commands = null, bool $json_payload = false){
        return $this->APICall("setMyCommands", ["commands" => $commands], $json_payload);
    }

    /**
     * Use this method to get the current list of the bot's commands.
     * Requires no parameters.
     * Returns Array of BotCommand on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\BotCommand[]
     */
    public function getMyCommands(bool $json_payload = false){
        return $this->APICall("getMyCommands", $params ?? [], $json_payload);
    }

    /**
     * Use this method to edit text and game messages.
     * On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message|bool
     */
    public function editMessageText($text, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($text)){
            $json_payload = $args ?? false; // 2nd param
            $params = $text ?? [];
        }
        else{
            $params = ["text" => $text] + ($args ?? []);
        }
        return $this->APICall("editMessageText", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to edit captions of messages.
     * On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message|bool
     */
    public function editMessageCaption($args = null, bool $json_payload = false, ...$kwargs){
        $params = $args;
        return $this->APICall("editMessageCaption", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to edit animation, audio, document, photo, or video messages.
     * If a message is part of a message album, then it can be edited only to an audio for audio albums, only to a document for document albums and to a photo or a video otherwise.
     * When an inline message is edited, a new file can't be uploaded.
     * Use a previously uploaded file via its file_id or specify a URL.
     * On success, if the edited message was sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message|bool
     */
    public function editMessageMedia($media, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($media)){
            $json_payload = $args ?? false; // 2nd param
            $params = $media ?? [];
        }
        else{
            $params = ["media" => $media] + ($args ?? []);
        }
        return $this->APICall("editMessageMedia", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to edit only the reply markup of messages.
     * On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message|bool
     */
    public function editMessageReplyMarkup($args = null, bool $json_payload = false, ...$kwargs){
        $params = $args;
        return $this->APICall("editMessageReplyMarkup", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to stop a poll which was sent by the bot.
     * On success, the stopped Poll with the final results is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Poll
     */
    public function stopPoll($chat_id, $message_id = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $message_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "message_id" => $message_id] + ($args ?? []);
        }
        return $this->APICall("stopPoll", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to delete a message, including service messages, with the following limitations:- A message can only be deleted if it was sent less than 48 hours ago.- A dice message in a private chat can only be deleted if it was sent more than 24 hours ago.- Bots can delete outgoing messages in private chats, groups, and supergroups.- Bots can delete incoming messages in private chats.- Bots granted can_post_messages permissions can delete outgoing messages in channels.- If the bot is an administrator of a group, it can delete any message there.- If the bot has can_delete_messages permission in a supergroup or a channel, it can delete any message there.Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function deleteMessage($chat_id, $message_id = null, bool $json_payload = false){
        if(is_array($chat_id)){
            $json_payload = $message_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "message_id" => $message_id] + ($args ?? []);
        }
        return $this->APICall("deleteMessage", $params ?? [], $json_payload);
    }

    /**
     * Use this method to send static .WEBP or animated .TGS stickers.
     * On success, the sent Message is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message
     */
    public function sendSticker($chat_id, $sticker = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $sticker ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "sticker" => $sticker] + ($args ?? []);
        }
        return $this->APICall("sendSticker", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to get a sticker set.
     * On success, a StickerSet object is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\StickerSet
     */
    public function getStickerSet($name, bool $json_payload = false){
        if(is_array($name)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $name ?? [];
        }
        else{
            $params = ["name" => $name] + ($args ?? []);
        }
        return $this->APICall("getStickerSet", $params ?? [], $json_payload);
    }

    /**
     * Use this method to upload a .PNG file with a sticker for later use in createNewStickerSet and addStickerToSet methods (can be used multiple times).
     * Returns the uploaded File on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\File
     */
    public function uploadStickerFile($user_id, $png_sticker = null, bool $json_payload = false){
        if(is_array($user_id)){
            $json_payload = $png_sticker ?? false; // 2nd param
            $params = $user_id ?? [];
        }
        else{
            $params = ["user_id" => $user_id, "png_sticker" => $png_sticker] + ($args ?? []);
        }
        return $this->APICall("uploadStickerFile", $params ?? [], $json_payload);
    }

    /**
     * Use this method to create a new sticker set owned by a user.
     * The bot will be able to edit the sticker set thus created.
     * You must use exactly one of the fields png_sticker or tgs_sticker.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function createNewStickerSet($user_id, $name = null, string $title = null, string $emojis = null, array $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($user_id)){
            $json_payload = $name ?? false; // 2nd param
            $params = $user_id ?? [];
        }
        else{
            $params = ["user_id" => $user_id, "name" => $name, "title" => $title, "emojis" => $emojis] + ($args ?? []);
        }
        return $this->APICall("createNewStickerSet", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to add a new sticker to a set created by the bot.
     * You must use exactly one of the fields png_sticker or tgs_sticker.
     * Animated stickers can be added to animated sticker sets and only to them.
     * Animated sticker sets can have up to 50 stickers.
     * Static sticker sets can have up to 120 stickers.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function addStickerToSet($user_id, $name = null, string $emojis = null, array $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($user_id)){
            $json_payload = $name ?? false; // 2nd param
            $params = $user_id ?? [];
        }
        else{
            $params = ["user_id" => $user_id, "name" => $name, "emojis" => $emojis] + ($args ?? []);
        }
        return $this->APICall("addStickerToSet", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to move a sticker in a set created by the bot to a specific position.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function setStickerPositionInSet($sticker, $position = null, bool $json_payload = false){
        if(is_array($sticker)){
            $json_payload = $position ?? false; // 2nd param
            $params = $sticker ?? [];
        }
        else{
            $params = ["sticker" => $sticker, "position" => $position] + ($args ?? []);
        }
        return $this->APICall("setStickerPositionInSet", $params ?? [], $json_payload);
    }

    /**
     * Use this method to delete a sticker from a set created by the bot.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function deleteStickerFromSet($sticker, bool $json_payload = false){
        if(is_array($sticker)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $sticker ?? [];
        }
        else{
            $params = ["sticker" => $sticker] + ($args ?? []);
        }
        return $this->APICall("deleteStickerFromSet", $params ?? [], $json_payload);
    }

    /**
     * Use this method to set the thumbnail of a sticker set.
     * Animated thumbnails can be set for animated sticker sets only.
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function setStickerSetThumb($name, $user_id = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($name)){
            $json_payload = $user_id ?? false; // 2nd param
            $params = $name ?? [];
        }
        else{
            $params = ["name" => $name, "user_id" => $user_id] + ($args ?? []);
        }
        return $this->APICall("setStickerSetThumb", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to send answers to an inline query.
     * On success, True is returned.No more than 50 results per query are allowed.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function answerInlineQuery($inline_query_id, $results = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($inline_query_id)){
            $json_payload = $results ?? false; // 2nd param
            $params = $inline_query_id ?? [];
        }
        else{
            $params = ["inline_query_id" => $inline_query_id, "results" => $results] + ($args ?? []);
        }
        return $this->APICall("answerInlineQuery", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to send invoices.
     * On success, the sent Message is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message
     */
    public function sendInvoice($chat_id, $title = null, string $description = null, string $payload = null, string $provider_token = null, string $start_parameter = null, string $currency = null, array $prices = null, array $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $title ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "title" => $title, "description" => $description, "payload" => $payload, "provider_token" => $provider_token, "start_parameter" => $start_parameter, "currency" => $currency, "prices" => $prices] + ($args ?? []);
        }
        return $this->APICall("sendInvoice", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * If you sent an invoice requesting a shipping address and the parameter is_flexible was specified, the Bot API will send an Update with a shipping_query field to the bot.
     * Use this method to reply to shipping queries.
     * On success, True is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function answerShippingQuery($shipping_query_id, $ok = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($shipping_query_id)){
            $json_payload = $ok ?? false; // 2nd param
            $params = $shipping_query_id ?? [];
        }
        else{
            $params = ["shipping_query_id" => $shipping_query_id, "ok" => $ok] + ($args ?? []);
        }
        return $this->APICall("answerShippingQuery", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the form of an Update with the field pre_checkout_query.
     * Use this method to respond to such pre-checkout queries.
     * On success, True is returned.
     * Note: The Bot API must receive an answer within 10 seconds after the pre-checkout query was sent.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function answerPreCheckoutQuery($pre_checkout_query_id, $ok = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($pre_checkout_query_id)){
            $json_payload = $ok ?? false; // 2nd param
            $params = $pre_checkout_query_id ?? [];
        }
        else{
            $params = ["pre_checkout_query_id" => $pre_checkout_query_id, "ok" => $ok] + ($args ?? []);
        }
        return $this->APICall("answerPreCheckoutQuery", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Informs a user that some of the Telegram Passport elements they provided contains errors.
     * The user will not be able to re-submit their Passport to you until the errors are fixed (the contents of the field for which you returned the error must change).
     * Returns True on success.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return bool
     */
    public function setPassportDataErrors($user_id, $errors = null, bool $json_payload = false){
        if(is_array($user_id)){
            $json_payload = $errors ?? false; // 2nd param
            $params = $user_id ?? [];
        }
        else{
            $params = ["user_id" => $user_id, "errors" => $errors] + ($args ?? []);
        }
        return $this->APICall("setPassportDataErrors", $params ?? [], $json_payload);
    }

    /**
     * Use this method to send a game.
     * On success, the sent Message is returned.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message
     */
    public function sendGame($chat_id, $game_short_name = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($chat_id)){
            $json_payload = $game_short_name ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "game_short_name" => $game_short_name] + ($args ?? []);
        }
        return $this->APICall("sendGame", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to set the score of the specified user in a game.
     * On success, if the message was sent by the bot, returns the edited Message, otherwise returns True.
     * Returns an error, if the new score is not greater than the user's current score in the chat and force is False.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\Message|bool
     */
    public function setGameScore($user_id, $score = null, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($user_id)){
            $json_payload = $score ?? false; // 2nd param
            $params = $user_id ?? [];
        }
        else{
            $params = ["user_id" => $user_id, "score" => $score] + ($args ?? []);
        }
        return $this->APICall("setGameScore", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

    /**
     * Use this method to get data for high score tables.
     * Will return the score of the specified user and several of their neighbors in a game.
     * On success, returns an Array of GameHighScore objects.
     *
     * @param bool $json_payload Whether to use json payload for this method.
     *
     * @return skrtdev\Telegram\GameHighScore[]
     */
    public function getGameHighScores($user_id, $args = null, bool $json_payload = false, ...$kwargs){
        if(is_array($user_id)){
            $json_payload = $args ?? false; // 2nd param
            $params = $user_id ?? [];
        }
        else{
            $params = ["user_id" => $user_id] + ($args ?? []);
        }
        return $this->APICall("getGameHighScores", ($kwargs ?? []) + ($params ?? []), $json_payload);
    }

}
