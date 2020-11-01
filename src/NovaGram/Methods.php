<?php

namespace skrtdev\NovaGram;

trait Methods{

    /**
     * Use this method to receive incoming updates using long polling (wiki). An Array of Update objects is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function getUpdates($args = null, bool $payload = false){
        $params = $args;
        return $this->APICall("getUpdates", $params ?? [], $payload);
    }

    /**
     * Use this method to specify a url and receive incoming updates via an outgoing webhook. Whenever there is an update for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update. In case of an unsuccessful request, we will give up after a reasonable amount of attempts. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function setWebhook($url, $args = null, bool $payload = false){
        if(is_array($url)){
            $payload = $args ?? false; // 2nd param
            $params = $url ?? [];
        }
        else{
            $params = ["url" => $url] + ($args ?? []);
        }
        return $this->APICall("setWebhook", $params ?? [], $payload);
    }

    /**
     * Use this method to remove webhook integration if you decide to switch back to getUpdates. Returns True on success. Requires no parameters.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function deleteWebhook(bool $payload = false){
        $params = [];
        return $this->APICall("deleteWebhook", $params ?? [], $payload);
    }

    /**
     * Use this method to get current webhook status. Requires no parameters. On success, returns a WebhookInfo object. If the bot is using getUpdates, will return an object with the url field empty.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function getWebhookInfo(bool $payload = false){
        $params = [];
        return $this->APICall("getWebhookInfo", $params ?? [], $payload);
    }

    /**
     * A simple method for testing your bot's auth token. Requires no parameters. Returns basic information about the bot in form of a User object.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function getMe(bool $payload = false){
        $params = [];
        return $this->APICall("getMe", $params ?? [], $payload);
    }

    /**
     * Use this method to send text messages. On success, the sent Message is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendMessage($chat_id, $text = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $text ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "text" => $text] + ($args ?? []);
        }
        return $this->APICall("sendMessage", $params ?? [], $payload);
    }

    /**
     * Use this method to forward messages of any kind. On success, the sent Message is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function forwardMessage($chat_id, $from_chat_id = null, int $message_id = null, array $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $from_chat_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "from_chat_id" => $from_chat_id, "message_id" => $message_id] + ($args ?? []);
        }
        return $this->APICall("forwardMessage", $params ?? [], $payload);
    }

    /**
     * Use this method to send photos. On success, the sent Message is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendPhoto($chat_id, $photo = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $photo ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "photo" => $photo] + ($args ?? []);
        }
        return $this->APICall("sendPhoto", $params ?? [], $payload);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player. Your audio must be in the .MP3 or .M4A format. On success, the sent Message is returned. Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendAudio($chat_id, $audio = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $audio ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "audio" => $audio] + ($args ?? []);
        }
        return $this->APICall("sendAudio", $params ?? [], $payload);
    }

    /**
     * Use this method to send general files. On success, the sent Message is returned. Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendDocument($chat_id, $document = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $document ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "document" => $document] + ($args ?? []);
        }
        return $this->APICall("sendDocument", $params ?? [], $payload);
    }

    /**
     * Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as Document). On success, the sent Message is returned. Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendVideo($chat_id, $video = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $video ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "video" => $video] + ($args ?? []);
        }
        return $this->APICall("sendVideo", $params ?? [], $payload);
    }

    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). On success, the sent Message is returned. Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendAnimation($chat_id, $animation = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $animation ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "animation" => $animation] + ($args ?? []);
        }
        return $this->APICall("sendAnimation", $params ?? [], $payload);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message. For this to work, your audio must be in an .OGG file encoded with OPUS (other formats may be sent as Audio or Document). On success, the sent Message is returned. Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendVoice($chat_id, $voice = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $voice ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "voice" => $voice] + ($args ?? []);
        }
        return $this->APICall("sendVoice", $params ?? [], $payload);
    }

    /**
     * As of v.4.0, Telegram clients support rounded square mp4 videos of up to 1 minute long. Use this method to send video messages. On success, the sent Message is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendVideoNote($chat_id, $video_note = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $video_note ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "video_note" => $video_note] + ($args ?? []);
        }
        return $this->APICall("sendVideoNote", $params ?? [], $payload);
    }

    /**
     * Use this method to send a group of photos or videos as an album. On success, an array of the sent Messages is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendMediaGroup($chat_id, $media = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $media ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "media" => $media] + ($args ?? []);
        }
        return $this->APICall("sendMediaGroup", $params ?? [], $payload);
    }

    /**
     * Use this method to send point on the map. On success, the sent Message is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendLocation($chat_id, $latitude = null, float $longitude = null, array $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $latitude ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "latitude" => $latitude, "longitude" => $longitude] + ($args ?? []);
        }
        return $this->APICall("sendLocation", $params ?? [], $payload);
    }

    /**
     * Use this method to edit live location messages. A location can be edited until its live_period expires or editing is explicitly disabled by a call to stopMessageLiveLocation. On success, if the edited message was sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function editMessageLiveLocation($latitude, $longitude = null, $args = null, bool $payload = false){
        if(is_array($latitude)){
            $payload = $longitude ?? false; // 2nd param
            $params = $latitude ?? [];
        }
        else{
            $params = ["latitude" => $latitude, "longitude" => $longitude] + ($args ?? []);
        }
        return $this->APICall("editMessageLiveLocation", $params ?? [], $payload);
    }

    /**
     * Use this method to stop updating a live location message before live_period expires. On success, if the message was sent by the bot, the sent Message is returned, otherwise True is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function stopMessageLiveLocation($args = null, bool $payload = false){
        $params = $args;
        return $this->APICall("stopMessageLiveLocation", $params ?? [], $payload);
    }

    /**
     * Use this method to send information about a venue. On success, the sent Message is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendVenue($chat_id, $latitude = null, float $longitude = null, string $title = null, string $address = null, array $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $latitude ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "latitude" => $latitude, "longitude" => $longitude, "title" => $title, "address" => $address] + ($args ?? []);
        }
        return $this->APICall("sendVenue", $params ?? [], $payload);
    }

    /**
     * Use this method to send phone contacts. On success, the sent Message is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendContact($chat_id, $phone_number = null, string $first_name = null, array $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $phone_number ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "phone_number" => $phone_number, "first_name" => $first_name] + ($args ?? []);
        }
        return $this->APICall("sendContact", $params ?? [], $payload);
    }

    /**
     * Use this method to send a native poll. On success, the sent Message is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendPoll($chat_id, $question = null, array $options = null, array $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $question ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "question" => $question, "options" => $options] + ($args ?? []);
        }
        return $this->APICall("sendPoll", $params ?? [], $payload);
    }

    /**
     * Use this method to send an animated emoji that will display a random value. On success, the sent Message is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendDice($chat_id, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $args ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("sendDice", $params ?? [], $payload);
    }

    /**
     * Use this method when you need to tell the user that something is happening on the bot's side. The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status). Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendChatAction($chat_id, $action = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $action ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "action" => $action] + ($args ?? []);
        }
        return $this->APICall("sendChatAction", $params ?? [], $payload);
    }

    /**
     * Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function getUserProfilePhotos($user_id, $args = null, bool $payload = false){
        if(is_array($user_id)){
            $payload = $args ?? false; // 2nd param
            $params = $user_id ?? [];
        }
        else{
            $params = ["user_id" => $user_id] + ($args ?? []);
        }
        return $this->APICall("getUserProfilePhotos", $params ?? [], $payload);
    }

    /**
     * Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download files of up to 20MB in size. On success, a File object is returned. The file can then be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>, where <file_path> is taken from the response. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile again.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function getFile($file_id, bool $payload = false){
        if(is_array($file_id)){
            $payload = $payload ?? false; // 2nd param
            $params = $file_id ?? [];
        }
        else{
            $params = ["file_id" => $file_id] + ($args ?? []);
        }
        return $this->APICall("getFile", $params ?? [], $payload);
    }

    /**
     * Use this method to kick a user from a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the group on their own using invite links, etc., unless unbanned first. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function kickChatMember($chat_id, $user_id = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $user_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "user_id" => $user_id] + ($args ?? []);
        }
        return $this->APICall("kickChatMember", $params ?? [], $payload);
    }

    /**
     * Use this method to unban a previously kicked user in a supergroup or channel. The user will not return to the group or channel automatically, but will be able to join via link, etc. The bot must be an administrator for this to work. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function unbanChatMember($chat_id, $user_id = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $user_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "user_id" => $user_id] + ($args ?? []);
        }
        return $this->APICall("unbanChatMember", $params ?? [], $payload);
    }

    /**
     * Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have the appropriate admin rights. Pass True for all permissions to lift restrictions from a user. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function restrictChatMember($chat_id, $user_id = null, ChatPermissions $permissions = null, array $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $user_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "user_id" => $user_id, "permissions" => $permissions] + ($args ?? []);
        }
        return $this->APICall("restrictChatMember", $params ?? [], $payload);
    }

    /**
     * Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Pass False for all boolean parameters to demote a user. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function promoteChatMember($chat_id, $user_id = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $user_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "user_id" => $user_id] + ($args ?? []);
        }
        return $this->APICall("promoteChatMember", $params ?? [], $payload);
    }

    /**
     * Use this method to set a custom title for an administrator in a supergroup promoted by the bot. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function setChatAdministratorCustomTitle($chat_id, $user_id = null, string $custom_title = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $user_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "user_id" => $user_id, "custom_title" => $custom_title] + ($args ?? []);
        }
        return $this->APICall("setChatAdministratorCustomTitle", $params ?? [], $payload);
    }

    /**
     * Use this method to set default chat permissions for all members. The bot must be an administrator in the group or a supergroup for this to work and must have the can_restrict_members admin rights. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function setChatPermissions($chat_id, $permissions = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $permissions ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "permissions" => $permissions] + ($args ?? []);
        }
        return $this->APICall("setChatPermissions", $params ?? [], $payload);
    }

    /**
     * Use this method to generate a new invite link for a chat; any previously generated link is revoked. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns the new invite link as String on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function exportChatInviteLink($chat_id, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("exportChatInviteLink", $params ?? [], $payload);
    }

    /**
     * Use this method to set a new profile photo for the chat. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function setChatPhoto($chat_id, $photo = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $photo ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "photo" => $photo] + ($args ?? []);
        }
        return $this->APICall("setChatPhoto", $params ?? [], $payload);
    }

    /**
     * Use this method to delete a chat photo. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function deleteChatPhoto($chat_id, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("deleteChatPhoto", $params ?? [], $payload);
    }

    /**
     * Use this method to change the title of a chat. Titles can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function setChatTitle($chat_id, $title = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $title ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "title" => $title] + ($args ?? []);
        }
        return $this->APICall("setChatTitle", $params ?? [], $payload);
    }

    /**
     * Use this method to change the description of a group, a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function setChatDescription($chat_id, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $args ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("setChatDescription", $params ?? [], $payload);
    }

    /**
     * Use this method to pin a message in a group, a supergroup, or a channel. The bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' admin right in the supergroup or 'can_edit_messages' admin right in the channel. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function pinChatMessage($chat_id, $message_id = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $message_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "message_id" => $message_id] + ($args ?? []);
        }
        return $this->APICall("pinChatMessage", $params ?? [], $payload);
    }

    /**
     * Use this method to unpin a message in a group, a supergroup, or a channel. The bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' admin right in the supergroup or 'can_edit_messages' admin right in the channel. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function unpinChatMessage($chat_id, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("unpinChatMessage", $params ?? [], $payload);
    }

    /**
     * Use this method for your bot to leave a group, supergroup or channel. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function leaveChat($chat_id, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("leaveChat", $params ?? [], $payload);
    }

    /**
     * Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.). Returns a Chat object on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function getChat($chat_id, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("getChat", $params ?? [], $payload);
    }

    /**
     * Use this method to get a list of administrators in a chat. On success, returns an Array of ChatMember objects that contains information about all chat administrators except other bots. If the chat is a group or a supergroup and no administrators were appointed, only the creator will be returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function getChatAdministrators($chat_id, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("getChatAdministrators", $params ?? [], $payload);
    }

    /**
     * Use this method to get the number of members in a chat. Returns Int on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function getChatMembersCount($chat_id, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("getChatMembersCount", $params ?? [], $payload);
    }

    /**
     * Use this method to get information about a member of a chat. Returns a ChatMember object on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function getChatMember($chat_id, $user_id = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $user_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "user_id" => $user_id] + ($args ?? []);
        }
        return $this->APICall("getChatMember", $params ?? [], $payload);
    }

    /**
     * Use this method to set a new group sticker set for a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function setChatStickerSet($chat_id, $sticker_set_name = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $sticker_set_name ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "sticker_set_name" => $sticker_set_name] + ($args ?? []);
        }
        return $this->APICall("setChatStickerSet", $params ?? [], $payload);
    }

    /**
     * Use this method to delete a group sticker set from a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function deleteChatStickerSet($chat_id, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $payload ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id] + ($args ?? []);
        }
        return $this->APICall("deleteChatStickerSet", $params ?? [], $payload);
    }

    /**
     * Use this method to send answers to callback queries sent from inline keyboards. The answer will be displayed to the user as a notification at the top of the chat screen or as an alert. On success, True is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function answerCallbackQuery($callback_query_id, $args = null, bool $payload = false){
        if(is_array($callback_query_id)){
            $payload = $args ?? false; // 2nd param
            $params = $callback_query_id ?? [];
        }
        else{
            $params = ["callback_query_id" => $callback_query_id] + ($args ?? []);
        }
        return $this->APICall("answerCallbackQuery", $params ?? [], $payload);
    }

    /**
     * Use this method to change the list of the bot's commands. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function setMyCommands($args = null, bool $payload = false){
        $params = $args;
        return $this->APICall("setMyCommands", $params ?? [], $payload);
    }

    /**
     * Use this method to get the current list of the bot's commands. Requires no parameters. Returns Array of BotCommand on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function getMyCommands(bool $payload = false){
        $params = [];
        return $this->APICall("getMyCommands", $params ?? [], $payload);
    }

    /**
     * Use this method to edit text and game messages. On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function editMessageText($args = null, bool $payload = false){
        $params = $args;
        return $this->APICall("editMessageText", $params ?? [], $payload);
    }

    /**
     * Use this method to edit captions of messages. On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function editMessageCaption($media, $args = null, bool $payload = false){
        if(is_array($media)){
            $payload = $args ?? false; // 2nd param
            $params = $media ?? [];
        }
        else{
            $params = ["media" => $media] + ($args ?? []);
        }
        return $this->APICall("editMessageCaption", $params ?? [], $payload);
    }

    /**
     * Use this method to edit animation, audio, document, photo, or video messages. If a message is a part of a message album, then it can be edited only to a photo or a video. Otherwise, message type can be changed arbitrarily. When inline message is edited, new file can't be uploaded. Use previously uploaded file via its file_id or specify a URL. On success, if the edited message was sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function editMessageMedia($args = null, bool $payload = false){
        $params = $args;
        return $this->APICall("editMessageMedia", $params ?? [], $payload);
    }

    /**
     * Use this method to edit only the reply markup of messages. On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function editMessageReplyMarkup($chat_id, $message_id = null, $args = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $message_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "message_id" => $message_id] + ($args ?? []);
        }
        return $this->APICall("editMessageReplyMarkup", $params ?? [], $payload);
    }

    /**
     * Use this method to stop a poll which was sent by the bot. On success, the stopped Poll with the final results is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function stopPoll($chat_id, $message_id = null, bool $payload = false){
        if(is_array($chat_id)){
            $payload = $message_id ?? false; // 2nd param
            $params = $chat_id ?? [];
        }
        else{
            $params = ["chat_id" => $chat_id, "message_id" => $message_id] + ($args ?? []);
        }
        return $this->APICall("stopPoll", $params ?? [], $payload);
    }

    /**
     * Use this method to delete a message, including service messages, with the following limitations:- A message can only be deleted if it was sent less than 48 hours ago.- A dice message in a private chat can only be deleted if it was sent more than 24 hours ago.- Bots can delete outgoing messages in private chats, groups, and supergroups.- Bots can delete incoming messages in private chats.- Bots granted can_post_messages permissions can delete outgoing messages in channels.- If the bot is an administrator of a group, it can delete any message there.- If the bot has can_delete_messages permission in a supergroup or a channel, it can delete any message there.Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function deleteMessage($args = null, bool $payload = false){
        $params = $args;
        return $this->APICall("deleteMessage", $params ?? [], $payload);
    }

    /**
     * Use this method to send static .WEBP or animated .TGS stickers. On success, the sent Message is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendSticker($name, bool $payload = false){
        if(is_array($name)){
            $payload = $payload ?? false; // 2nd param
            $params = $name ?? [];
        }
        else{
            $params = ["name" => $name] + ($args ?? []);
        }
        return $this->APICall("sendSticker", $params ?? [], $payload);
    }

    /**
     * Use this method to get a sticker set. On success, a StickerSet object is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function getStickerSet($user_id, $png_sticker = null, bool $payload = false){
        if(is_array($user_id)){
            $payload = $png_sticker ?? false; // 2nd param
            $params = $user_id ?? [];
        }
        else{
            $params = ["user_id" => $user_id, "png_sticker" => $png_sticker] + ($args ?? []);
        }
        return $this->APICall("getStickerSet", $params ?? [], $payload);
    }

    /**
     * Use this method to upload a .PNG file with a sticker for later use in createNewStickerSet and addStickerToSet methods (can be used multiple times). Returns the uploaded File on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function uploadStickerFile($user_id, $name = null, string $title = null, string $emojis = null, array $args = null, bool $payload = false){
        if(is_array($user_id)){
            $payload = $name ?? false; // 2nd param
            $params = $user_id ?? [];
        }
        else{
            $params = ["user_id" => $user_id, "name" => $name, "title" => $title, "emojis" => $emojis] + ($args ?? []);
        }
        return $this->APICall("uploadStickerFile", $params ?? [], $payload);
    }

    /**
     * Use this method to create a new sticker set owned by a user. The bot will be able to edit the sticker set thus created. You must use exactly one of the fields png_sticker or tgs_sticker. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function createNewStickerSet($user_id, $name = null, string $emojis = null, array $args = null, bool $payload = false){
        if(is_array($user_id)){
            $payload = $name ?? false; // 2nd param
            $params = $user_id ?? [];
        }
        else{
            $params = ["user_id" => $user_id, "name" => $name, "emojis" => $emojis] + ($args ?? []);
        }
        return $this->APICall("createNewStickerSet", $params ?? [], $payload);
    }

    /**
     * Use this method to add a new sticker to a set created by the bot. You must use exactly one of the fields png_sticker or tgs_sticker. Animated stickers can be added to animated sticker sets and only to them. Animated sticker sets can have up to 50 stickers. Static sticker sets can have up to 120 stickers. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function addStickerToSet($sticker, $position = null, bool $payload = false){
        if(is_array($sticker)){
            $payload = $position ?? false; // 2nd param
            $params = $sticker ?? [];
        }
        else{
            $params = ["sticker" => $sticker, "position" => $position] + ($args ?? []);
        }
        return $this->APICall("addStickerToSet", $params ?? [], $payload);
    }

    /**
     * Use this method to move a sticker in a set created by the bot to a specific position. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function setStickerPositionInSet($sticker, bool $payload = false){
        if(is_array($sticker)){
            $payload = $payload ?? false; // 2nd param
            $params = $sticker ?? [];
        }
        else{
            $params = ["sticker" => $sticker] + ($args ?? []);
        }
        return $this->APICall("setStickerPositionInSet", $params ?? [], $payload);
    }

    /**
     * Use this method to delete a sticker from a set created by the bot. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function deleteStickerFromSet($name, $user_id = null, $args = null, bool $payload = false){
        if(is_array($name)){
            $payload = $user_id ?? false; // 2nd param
            $params = $name ?? [];
        }
        else{
            $params = ["name" => $name, "user_id" => $user_id] + ($args ?? []);
        }
        return $this->APICall("deleteStickerFromSet", $params ?? [], $payload);
    }

    /**
     * Use this method to set the thumbnail of a sticker set. Animated thumbnails can be set for animated sticker sets only. Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function setStickerSetThumb($args = null, bool $payload = false){
        $params = $args;
        return $this->APICall("setStickerSetThumb", $params ?? [], $payload);
    }

    /**
     * Use this method to send answers to an inline query. On success, True is returned.No more than 50 results per query are allowed.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function answerInlineQuery($args = null, bool $payload = false){
        $params = $args;
        return $this->APICall("answerInlineQuery", $params ?? [], $payload);
    }

    /**
     * Use this method to send invoices. On success, the sent Message is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendInvoice($shipping_query_id, $ok = null, $args = null, bool $payload = false){
        if(is_array($shipping_query_id)){
            $payload = $ok ?? false; // 2nd param
            $params = $shipping_query_id ?? [];
        }
        else{
            $params = ["shipping_query_id" => $shipping_query_id, "ok" => $ok] + ($args ?? []);
        }
        return $this->APICall("sendInvoice", $params ?? [], $payload);
    }

    /**
     * If you sent an invoice requesting a shipping address and the parameter is_flexible was specified, the Bot API will send an Update with a shipping_query field to the bot. Use this method to reply to shipping queries. On success, True is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function answerShippingQuery($pre_checkout_query_id, $ok = null, $args = null, bool $payload = false){
        if(is_array($pre_checkout_query_id)){
            $payload = $ok ?? false; // 2nd param
            $params = $pre_checkout_query_id ?? [];
        }
        else{
            $params = ["pre_checkout_query_id" => $pre_checkout_query_id, "ok" => $ok] + ($args ?? []);
        }
        return $this->APICall("answerShippingQuery", $params ?? [], $payload);
    }

    /**
     * Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the form of an Update with the field pre_checkout_query. Use this method to respond to such pre-checkout queries. On success, True is returned. Note: The Bot API must receive an answer within 10 seconds after the pre-checkout query was sent.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function answerPreCheckoutQuery($args = null, bool $payload = false){
        $params = $args;
        return $this->APICall("answerPreCheckoutQuery", $params ?? [], $payload);
    }

    /**
     * Informs a user that some of the Telegram Passport elements they provided contains errors. The user will not be able to re-submit their Passport to you until the errors are fixed (the contents of the field for which you returned the error must change). Returns True on success.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function setPassportDataErrors($args = null, bool $payload = false){
        $params = $args;
        return $this->APICall("setPassportDataErrors", $params ?? [], $payload);
    }

    /**
     * Use this method to send a game. On success, the sent Message is returned.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function sendGame($args = null, bool $payload = false){
        $params = $args;
        return $this->APICall("sendGame", $params ?? [], $payload);
    }

    /**
     * Use this method to set the score of the specified user in a game. On success, if the message was sent by the bot, returns the edited Message, otherwise returns True. Returns an error, if the new score is not greater than the user's current score in the chat and force is False.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function setGameScore($user_id, $args = null, bool $payload = false){
        if(is_array($user_id)){
            $payload = $args ?? false; // 2nd param
            $params = $user_id ?? [];
        }
        else{
            $params = ["user_id" => $user_id] + ($args ?? []);
        }
        return $this->APICall("setGameScore", $params ?? [], $payload);
    }

    /**
     * Use this method to get data for high score tables. Will return the score of the specified user and several of their neighbors in a game. On success, returns an Array of GameHighScore objects.
     *
     * @param bool $payload Whether to use payload for this method.
     *
     * @return \skrtdev\Telegram\Type|bool|string
     */
    public function getGameHighScores($args = null, bool $payload = false){
        $params = $args;
        return $this->APICall("getGameHighScores", $params ?? [], $payload);
    }

}
