<?php declare(strict_types=1);

namespace skrtdev\NovaGram;

use skrtdev\Telegram\{BotCommand, Chat, ChatInviteLink, ChatMember, File, GameHighScore, Message, MessageId, ObjectsList, Poll, StickerSet, Update, User, UserProfilePhotos, WebhookInfo};

trait Methods{

    /**
     * Use this method to receive incoming updates using long polling (wiki).
     * An Array of Update objects is returned.
     * Arguments can be passed as named arguments.
     *
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Update[]|ObjectsList|null
     */
    public function getUpdates($args = null, bool $json_payload = false, ...$kwargs): ?ObjectsList
    {
        $params = $args;
        return $this->APICall('getUpdates', $kwargs + ($params ?? []), Update::class, $json_payload);
    }

    /**
     * Use this method to specify a url and receive incoming updates via an outgoing webhook.
     * Whenever there is an update for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update.
     * In case of an unsuccessful request, we will give up after a reasonable amount of attempts.
     * Returns True on success.
     *
     * @param array|string $url Method arguments array or HTTPS url to send updates to. Use an empty string to remove webhook integration
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function setWebhook($url, $args = null, bool $json_payload = false, ...$kwargs): ?bool
    {
        if(is_array($url)){
            $json_payload = $args ?? false; // 2nd param
            $params = $url;
        }
        else{
            $params = ['url' => $url] + ($args ?? []);
        }
        return $this->APICall('setWebhook', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Use this method to remove webhook integration if you decide to switch back to getUpdates.
     * Returns True on success.
     * Arguments can be passed as named arguments.
     *
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function deleteWebhook($args = null, bool $json_payload = false, ...$kwargs): ?bool
    {
        $params = $args;
        return $this->APICall('deleteWebhook', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Use this method to get current webhook status.
     * Requires no parameters.
     * On success, returns a WebhookInfo object.
     * If the bot is using getUpdates, will return an object with the url field empty.
     *
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return WebhookInfo|null
     */
    public function getWebhookInfo(bool $json_payload = false): ?WebhookInfo
    {
        return $this->APICall('getWebhookInfo', $params ?? [], WebhookInfo::class, $json_payload);
    }

    /**
     * A simple method for testing your bot's authentication token.
     * Requires no parameters.
     * Returns basic information about the bot in form of a User object.
     *
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return User|null
     */
    public function getMe(bool $json_payload = false): ?User
    {
        return $this->APICall('getMe', $params ?? [], User::class, $json_payload);
    }

    /**
     * Use this method to log out from the cloud Bot API server before launching the bot locally.
     * You must log out the bot before running it locally, otherwise there is no guarantee that the bot will receive updates.
     * After a successful call, you can immediately log in on a local server, but will not be able to log in back to the cloud Bot API server for 10 minutes.
     * Returns True on success.
     * Requires no parameters.
     *
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function logOut(bool $json_payload = false): ?bool
    {
        return $this->APICall('logOut', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to close the bot instance before moving it from one local server to another.
     * You need to delete the webhook before calling this method to ensure that the bot isn't launched again after server restart.
     * The method will return error 429 in the first 10 minutes after the bot is launched.
     * Returns True on success.
     * Requires no parameters.
     *
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function close(bool $json_payload = false): ?bool
    {
        return $this->APICall('close', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to send text messages.
     * On success, the sent Message is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $text Text of the message to be sent, 1-4096 characters after entities parsing
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|null
     */
    public function sendMessage($chat_id, $text = null, $args = null, bool $json_payload = false, ...$kwargs): ?Message
    {
        if(is_array($chat_id)){
            $json_payload = $text ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'text' => $text] + ($args ?? []);
        }
        return $this->APICall('sendMessage', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to forward messages of any kind.
     * Service messages can't be forwarded.
     * On success, the sent Message is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|string $from_chat_id Unique identifier for the chat where the original message was sent (or channel username in the format @channelusername)
     * @param int $message_id Message identifier in the chat specified in from_chat_id
     * @param array $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|null
     */
    public function forwardMessage($chat_id, $from_chat_id = null, int $message_id = null, array $args = [], bool $json_payload = false, ...$kwargs): ?Message
    {
        if(is_array($chat_id)){
            $json_payload = $from_chat_id ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'from_chat_id' => $from_chat_id, 'message_id' => $message_id] + ($args ?? []);
        }
        return $this->APICall('forwardMessage', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to copy messages of any kind.
     * Service messages and invoice messages can't be copied.
     * The method is analogous to the method forwardMessage, but the copied message doesn't have a link to the original message.
     * Returns the MessageId of the sent message on success.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|string $from_chat_id Unique identifier for the chat where the original message was sent (or channel username in the format @channelusername)
     * @param int $message_id Message identifier in the chat specified in from_chat_id
     * @param array $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return MessageId|null
     */
    public function copyMessage($chat_id, $from_chat_id = null, int $message_id = null, array $args = [], bool $json_payload = false, ...$kwargs): ?MessageId
    {
        if(is_array($chat_id)){
            $json_payload = $from_chat_id ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'from_chat_id' => $from_chat_id, 'message_id' => $message_id] + ($args ?? []);
        }
        return $this->APICall('copyMessage', $kwargs + ($params ?? []), MessageId::class, $json_payload);
    }

    /**
     * Use this method to send photos.
     * On success, the sent Message is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param array|string $photo Photo to send. Pass a file_id as String to send a photo that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a photo from the Internet, or upload a new photo using multipart/form-data. The photo must be at most 10 MB in size. The photo's width and height must not exceed 10000 in total. Width and height ratio must be at most 20. More info on Sending Files »
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|null
     */
    public function sendPhoto($chat_id, $photo = null, $args = null, bool $json_payload = false, ...$kwargs): ?Message
    {
        if(is_array($chat_id)){
            $json_payload = $photo ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'photo' => $photo] + ($args ?? []);
        }
        return $this->APICall('sendPhoto', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player.
     * Your audio must be in the .MP3 or .M4A format.
     * On success, the sent Message is returned.
     * Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     * For sending voice messages, use the sendVoice method instead.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param array|string $audio Audio file to send. Pass a file_id as String to send an audio file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get an audio file from the Internet, or upload a new one using multipart/form-data. More info on Sending Files »
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|null
     */
    public function sendAudio($chat_id, $audio = null, $args = null, bool $json_payload = false, ...$kwargs): ?Message
    {
        if(is_array($chat_id)){
            $json_payload = $audio ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'audio' => $audio] + ($args ?? []);
        }
        return $this->APICall('sendAudio', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to send general files.
     * On success, the sent Message is returned.
     * Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param array|string $document File to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data. More info on Sending Files »
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|null
     */
    public function sendDocument($chat_id, $document = null, $args = null, bool $json_payload = false, ...$kwargs): ?Message
    {
        if(is_array($chat_id)){
            $json_payload = $document ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'document' => $document] + ($args ?? []);
        }
        return $this->APICall('sendDocument', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as Document).
     * On success, the sent Message is returned.
     * Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param array|string $video Video to send. Pass a file_id as String to send a video that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a video from the Internet, or upload a new video using multipart/form-data. More info on Sending Files »
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|null
     */
    public function sendVideo($chat_id, $video = null, $args = null, bool $json_payload = false, ...$kwargs): ?Message
    {
        if(is_array($chat_id)){
            $json_payload = $video ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'video' => $video] + ($args ?? []);
        }
        return $this->APICall('sendVideo', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound).
     * On success, the sent Message is returned.
     * Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param array|string $animation Animation to send. Pass a file_id as String to send an animation that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get an animation from the Internet, or upload a new animation using multipart/form-data. More info on Sending Files »
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|null
     */
    public function sendAnimation($chat_id, $animation = null, $args = null, bool $json_payload = false, ...$kwargs): ?Message
    {
        if(is_array($chat_id)){
            $json_payload = $animation ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'animation' => $animation] + ($args ?? []);
        }
        return $this->APICall('sendAnimation', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message.
     * For this to work, your audio must be in an .OGG file encoded with OPUS (other formats may be sent as Audio or Document).
     * On success, the sent Message is returned.
     * Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param array|string $voice Audio file to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data. More info on Sending Files »
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|null
     */
    public function sendVoice($chat_id, $voice = null, $args = null, bool $json_payload = false, ...$kwargs): ?Message
    {
        if(is_array($chat_id)){
            $json_payload = $voice ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'voice' => $voice] + ($args ?? []);
        }
        return $this->APICall('sendVoice', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * As of v.4.0, Telegram clients support rounded square mp4 videos of up to 1 minute long.
     * Use this method to send video messages.
     * On success, the sent Message is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param array|string $video_note Video note to send. Pass a file_id as String to send a video note that exists on the Telegram servers (recommended) or upload a new video using multipart/form-data. More info on Sending Files ». Sending video notes by a URL is currently unsupported
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|null
     */
    public function sendVideoNote($chat_id, $video_note = null, $args = null, bool $json_payload = false, ...$kwargs): ?Message
    {
        if(is_array($chat_id)){
            $json_payload = $video_note ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'video_note' => $video_note] + ($args ?? []);
        }
        return $this->APICall('sendVideoNote', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to send a group of photos, videos, documents or audios as an album.
     * Documents and audio files can be only grouped in an album with messages of the same type.
     * On success, an array of Messages that were sent is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param array $media An array describing messages to be sent, must include 2-10 items
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message[]|ObjectsList|null
     */
    public function sendMediaGroup($chat_id, $media = null, $args = null, bool $json_payload = false, ...$kwargs): ?ObjectsList
    {
        if(is_array($chat_id)){
            $json_payload = $media ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'media' => $media] + ($args ?? []);
        }
        return $this->APICall('sendMediaGroup', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to send point on the map.
     * On success, the sent Message is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param float $latitude Latitude of the location
     * @param float $longitude Longitude of the location
     * @param array $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|null
     */
    public function sendLocation($chat_id, $latitude = null, float $longitude = null, array $args = [], bool $json_payload = false, ...$kwargs): ?Message
    {
        if(is_array($chat_id)){
            $json_payload = $latitude ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'latitude' => $latitude, 'longitude' => $longitude] + ($args ?? []);
        }
        return $this->APICall('sendLocation', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to edit live location messages.
     * A location can be edited until its live_period expires or editing is explicitly disabled by a call to stopMessageLiveLocation.
     * On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|float $latitude Method arguments array or Latitude of new location
     * @param float $longitude Longitude of new location
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|bool|null
     */
    public function editMessageLiveLocation($latitude, $longitude = null, $args = null, bool $json_payload = false, ...$kwargs)
    {
        if(is_array($latitude)){
            $json_payload = $longitude ?? false; // 2nd param
            $params = $latitude;
        }
        else{
            $params = ['latitude' => $latitude, 'longitude' => $longitude] + ($args ?? []);
        }
        return $this->APICall('editMessageLiveLocation', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to stop updating a live location message before live_period expires.
     * On success, if the message is not an inline message, the edited Message is returned, otherwise True is returned.
     * Arguments can be passed as named arguments.
     *
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|bool|null
     */
    public function stopMessageLiveLocation($args = null, bool $json_payload = false, ...$kwargs)
    {
        $params = $args;
        return $this->APICall('stopMessageLiveLocation', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to send information about a venue.
     * On success, the sent Message is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param float $latitude Latitude of the venue
     * @param float $longitude Longitude of the venue
     * @param string $title Name of the venue
     * @param string $address Address of the venue
     * @param array $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|null
     */
    public function sendVenue($chat_id, $latitude = null, float $longitude = null, string $title = null, string $address = null, array $args = [], bool $json_payload = false, ...$kwargs): ?Message
    {
        if(is_array($chat_id)){
            $json_payload = $latitude ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'latitude' => $latitude, 'longitude' => $longitude, 'title' => $title, 'address' => $address] + ($args ?? []);
        }
        return $this->APICall('sendVenue', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to send phone contacts.
     * On success, the sent Message is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $phone_number Contact's phone number
     * @param string $first_name Contact's first name
     * @param array $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|null
     */
    public function sendContact($chat_id, $phone_number = null, string $first_name = null, array $args = [], bool $json_payload = false, ...$kwargs): ?Message
    {
        if(is_array($chat_id)){
            $json_payload = $phone_number ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'phone_number' => $phone_number, 'first_name' => $first_name] + ($args ?? []);
        }
        return $this->APICall('sendContact', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to send a native poll.
     * On success, the sent Message is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $question Poll question, 1-300 characters
     * @param array $options A list of answer options, 2-10 strings 1-100 characters each
     * @param array $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|null
     */
    public function sendPoll($chat_id, $question = null, array $options = null, array $args = [], bool $json_payload = false, ...$kwargs): ?Message
    {
        if(is_array($chat_id)){
            $json_payload = $question ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'question' => $question, 'options' => $options] + ($args ?? []);
        }
        return $this->APICall('sendPoll', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to send an animated emoji that will display a random value.
     * On success, the sent Message is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|null
     */
    public function sendDice($chat_id, $args = null, bool $json_payload = false, ...$kwargs): ?Message
    {
        if(is_array($chat_id)){
            $json_payload = $args ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        return $this->APICall('sendDice', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method when you need to tell the user that something is happening on the bot's side.
     * The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status).
     * Returns True on success.
     * We only recommend using this method when a response from the bot will take a noticeable amount of time to arrive.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $action Type of action to broadcast. Choose one, depending on what the user is about to receive: typing for text messages, upload_photo for photos, record_video or upload_video for videos, record_voice or upload_voice for voice notes, upload_document for general files, choose_sticker for stickers, find_location for location data, record_video_note or upload_video_note for video notes.
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function sendChatAction($chat_id, $action = null, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $action ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'action' => $action] + ($args ?? []);
        }
        return $this->APICall('sendChatAction', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to get a list of profile pictures for a user.
     * Returns a UserProfilePhotos object.
     * Arguments can be passed as named arguments.
     *
     * @param array|int $user_id Method arguments array or Unique identifier of the target user
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return UserProfilePhotos|null
     */
    public function getUserProfilePhotos($user_id, $args = null, bool $json_payload = false, ...$kwargs): ?UserProfilePhotos
    {
        if(is_array($user_id)){
            $json_payload = $args ?? false; // 2nd param
            $params = $user_id;
        }
        else{
            $params = ['user_id' => $user_id] + ($args ?? []);
        }
        return $this->APICall('getUserProfilePhotos', $kwargs + ($params ?? []), UserProfilePhotos::class, $json_payload);
    }

    /**
     * Use this method to get basic info about a file and prepare it for downloading.
     * For the moment, bots can download files of up to 20MB in size.
     * On success, a File object is returned.
     * The file can then be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>, where <file_path> is taken from the response.
     * It is guaranteed that the link will be valid for at least 1 hour.
     * When the link expires, a new one can be requested by calling getFile again.
     *
     * @param array|string $file_id Method arguments array or File identifier to get info about
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return File|null
     */
    public function getFile($file_id, bool $json_payload = false): ?File
    {
        if(is_array($file_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $file_id;
        }
        else{
            $params = ['file_id' => $file_id] + ($args ?? []);
        }
        return $this->APICall('getFile', $params ?? [], File::class, $json_payload);
    }

    /**
     * Use this method to ban a user in a group, a supergroup or a channel.
     * In the case of supergroups and channels, the user will not be able to return to the chat on their own using invite links, etc., unless unbanned first.
     * The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
     * Returns True on success.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target group or username of the target supergroup or channel (in the format @channelusername)
     * @param int $user_id Unique identifier of the target user
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function banChatMember($chat_id, $user_id = null, $args = null, bool $json_payload = false, ...$kwargs): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $user_id ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'user_id' => $user_id] + ($args ?? []);
        }
        return $this->APICall('banChatMember', $kwargs + ($params ?? []), null, $json_payload);
    }


    public function kickChatMember(...$args): ?bool
    {
        Utils::trigger_error('Using removed kickChatMember, use banChatMember instead', E_USER_DEPRECATED);
        return $this->banChatMember(...$args);
    }

    /**
     * Use this method to unban a previously banned user in a supergroup or channel.
     * The user will not return to the group or channel automatically, but will be able to join via link, etc.
     * The bot must be an administrator for this to work.
     * By default, this method guarantees that after the call the user is not a member of the chat, but will be able to join it.
     * So if the user is a member of the chat they will also be removed from the chat.
     * If you don't want this, use the parameter only_if_banned.
     * Returns True on success.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target group or username of the target supergroup or channel (in the format @username)
     * @param int $user_id Unique identifier of the target user
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function unbanChatMember($chat_id, $user_id = null, $args = null, bool $json_payload = false, ...$kwargs): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $user_id ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'user_id' => $user_id] + ($args ?? []);
        }
        return $this->APICall('unbanChatMember', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Use this method to restrict a user in a supergroup.
     * The bot must be an administrator in the supergroup for this to work and must have the appropriate administrator rights.
     * Pass True for all permissions to lift restrictions from a user.
     * Returns True on success.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param int $user_id Unique identifier of the target user
     * @param array $permissions A JSON-serialized object for new user permissions
     * @param array $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function restrictChatMember($chat_id, $user_id = null, array $permissions = null, array $args = [], bool $json_payload = false, ...$kwargs): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $user_id ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'user_id' => $user_id, 'permissions' => $permissions] + ($args ?? []);
        }
        return $this->APICall('restrictChatMember', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Use this method to promote or demote a user in a supergroup or a channel.
     * The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
     * Pass False for all boolean parameters to demote a user.
     * Returns True on success.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $user_id Unique identifier of the target user
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function promoteChatMember($chat_id, $user_id = null, $args = null, bool $json_payload = false, ...$kwargs): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $user_id ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'user_id' => $user_id] + ($args ?? []);
        }
        return $this->APICall('promoteChatMember', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Use this method to set a custom title for an administrator in a supergroup promoted by the bot.
     * Returns True on success.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param int $user_id Unique identifier of the target user
     * @param string $custom_title New custom title for the administrator; 0-16 characters, emoji are not allowed
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function setChatAdministratorCustomTitle($chat_id, $user_id = null, string $custom_title = null, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $user_id ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'user_id' => $user_id, 'custom_title' => $custom_title] + ($args ?? []);
        }
        return $this->APICall('setChatAdministratorCustomTitle', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to ban a channel chat in a supergroup or a channel.
     * The owner of the chat will not be able to send messages and join live streams on behalf of the chat, unless it is unbanned first.
     * The bot must be an administrator in the supergroup or channel for this to work and must have the appropriate administrator rights.
     * Returns True on success.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $sender_chat_id Unique identifier of the target sender chat
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function banChatSenderChat($chat_id, $sender_chat_id = null, $args = null, bool $json_payload = false, ...$kwargs): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $sender_chat_id ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'sender_chat_id' => $sender_chat_id] + ($args ?? []);
        }
        return $this->APICall('banChatSenderChat', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Use this method to unban a previously banned channel chat in a supergroup or channel.
     * The bot must be an administrator for this to work and must have the appropriate administrator rights.
     * Returns True on success.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $sender_chat_id Unique identifier of the target sender chat
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function unbanChatSenderChat($chat_id, $sender_chat_id = null, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $sender_chat_id ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'sender_chat_id' => $sender_chat_id] + ($args ?? []);
        }
        return $this->APICall('unbanChatSenderChat', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to set default chat permissions for all members.
     * The bot must be an administrator in the group or a supergroup for this to work and must have the can_restrict_members administrator rights.
     * Returns True on success.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param array $permissions A JSON-serialized object for new default chat permissions
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function setChatPermissions($chat_id, $permissions = null, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $permissions ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'permissions' => $permissions] + ($args ?? []);
        }
        return $this->APICall('setChatPermissions', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to generate a new primary invite link for a chat; any previously generated primary link is revoked.
     * The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
     * Returns the new invite link as String on success.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return string|null
     */
    public function exportChatInviteLink($chat_id, bool $json_payload = false): ?string
    {
        if(is_array($chat_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        return $this->APICall('exportChatInviteLink', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to create an additional invite link for a chat.
     * The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
     * The link can be revoked using the method revokeChatInviteLink.
     * Returns the new invite link as ChatInviteLink object.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return ChatInviteLink|null
     */
    public function createChatInviteLink($chat_id, $args = null, bool $json_payload = false, ...$kwargs): ?ChatInviteLink
    {
        if(is_array($chat_id)){
            $json_payload = $args ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        return $this->APICall('createChatInviteLink', $kwargs + ($params ?? []), ChatInviteLink::class, $json_payload);
    }

    /**
     * Use this method to edit a non-primary invite link created by the bot.
     * The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
     * Returns the edited invite link as a ChatInviteLink object.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $invite_link The invite link to edit
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return ChatInviteLink|null
     */
    public function editChatInviteLink($chat_id, $invite_link = null, $args = null, bool $json_payload = false, ...$kwargs): ?ChatInviteLink
    {
        if(is_array($chat_id)){
            $json_payload = $invite_link ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'invite_link' => $invite_link] + ($args ?? []);
        }
        return $this->APICall('editChatInviteLink', $kwargs + ($params ?? []), ChatInviteLink::class, $json_payload);
    }

    /**
     * Use this method to revoke an invite link created by the bot.
     * If the primary link is revoked, a new link is automatically generated.
     * The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
     * Returns the revoked invite link as ChatInviteLink object.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier of the target chat or username of the target channel (in the format @channelusername)
     * @param string $invite_link The invite link to revoke
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return ChatInviteLink|null
     */
    public function revokeChatInviteLink($chat_id, $invite_link = null, bool $json_payload = false): ?ChatInviteLink
    {
        if(is_array($chat_id)){
            $json_payload = $invite_link ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'invite_link' => $invite_link] + ($args ?? []);
        }
        return $this->APICall('revokeChatInviteLink', $params ?? [], ChatInviteLink::class, $json_payload);
    }

    /**
     * Use this method to approve a chat join request.
     * The bot must be an administrator in the chat for this to work and must have the can_invite_users administrator right.
     * Returns True on success.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $user_id Unique identifier of the target user
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function approveChatJoinRequest($chat_id, $user_id = null, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $user_id ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'user_id' => $user_id] + ($args ?? []);
        }
        return $this->APICall('approveChatJoinRequest', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to decline a chat join request.
     * The bot must be an administrator in the chat for this to work and must have the can_invite_users administrator right.
     * Returns True on success.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $user_id Unique identifier of the target user
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function declineChatJoinRequest($chat_id, $user_id = null, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $user_id ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'user_id' => $user_id] + ($args ?? []);
        }
        return $this->APICall('declineChatJoinRequest', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to set a new profile photo for the chat.
     * Photos can't be changed for private chats.
     * The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
     * Returns True on success.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param array $photo New chat photo, uploaded using multipart/form-data
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function setChatPhoto($chat_id, $photo = null, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $photo ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'photo' => $photo] + ($args ?? []);
        }
        return $this->APICall('setChatPhoto', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to delete a chat photo.
     * Photos can't be changed for private chats.
     * The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
     * Returns True on success.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function deleteChatPhoto($chat_id, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        return $this->APICall('deleteChatPhoto', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to change the title of a chat.
     * Titles can't be changed for private chats.
     * The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
     * Returns True on success.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $title New chat title, 1-255 characters
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function setChatTitle($chat_id, $title = null, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $title ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'title' => $title] + ($args ?? []);
        }
        return $this->APICall('setChatTitle', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to change the description of a group, a supergroup or a channel.
     * The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
     * Returns True on success.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function setChatDescription($chat_id, $args = null, bool $json_payload = false, ...$kwargs): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $args ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        return $this->APICall('setChatDescription', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Use this method to add a message to the list of pinned messages in a chat.
     * If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' administrator right in a supergroup or 'can_edit_messages' administrator right in a channel.
     * Returns True on success.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $message_id Identifier of a message to pin
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function pinChatMessage($chat_id, $message_id = null, $args = null, bool $json_payload = false, ...$kwargs): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $message_id ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'message_id' => $message_id] + ($args ?? []);
        }
        return $this->APICall('pinChatMessage', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Use this method to remove a message from the list of pinned messages in a chat.
     * If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' administrator right in a supergroup or 'can_edit_messages' administrator right in a channel.
     * Returns True on success.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function unpinChatMessage($chat_id, $args = null, bool $json_payload = false, ...$kwargs): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $args ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        return $this->APICall('unpinChatMessage', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Use this method to clear the list of pinned messages in a chat.
     * If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' administrator right in a supergroup or 'can_edit_messages' administrator right in a channel.
     * Returns True on success.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function unpinAllChatMessages($chat_id, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        return $this->APICall('unpinAllChatMessages', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method for your bot to leave a group, supergroup or channel.
     * Returns True on success.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function leaveChat($chat_id, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        return $this->APICall('leaveChat', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.).
     * Returns a Chat object on success.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return Chat|null
     */
    public function getChat($chat_id, bool $json_payload = false): ?Chat
    {
        if(is_array($chat_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        return $this->APICall('getChat', $params ?? [], Chat::class, $json_payload);
    }

    /**
     * Use this method to get a list of administrators in a chat.
     * On success, returns an Array of ChatMember objects that contains information about all chat administrators except other bots.
     * If the chat is a group or a supergroup and no administrators were appointed, only the creator will be returned.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return ChatMember[]|ObjectsList|null
     */
    public function getChatAdministrators($chat_id, bool $json_payload = false): ?ObjectsList
    {
        if(is_array($chat_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        return $this->APICall('getChatAdministrators', $params ?? [], ChatMember::class, $json_payload);
    }

    /**
     * Use this method to get the number of members in a chat.
     * Returns Int on success.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return int|null
     */
    public function getChatMemberCount($chat_id, bool $json_payload = false): ?int
    {
        if(is_array($chat_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        return $this->APICall('getChatMemberCount', $params ?? [], null, $json_payload);
    }

    public function getChatMembersCount(...$args): ?int
    {
        Utils::trigger_error('Using removed getChatMembersCount, use getChatMembersCount instead', E_USER_DEPRECATED);
        return $this->getChatMembersCount(...$args);
    }

    /**
     * Use this method to get information about a member of a chat.
     * Returns a ChatMember object on success.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
     * @param int $user_id Unique identifier of the target user
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return ChatMember|null
     */
    public function getChatMember($chat_id, $user_id = null, bool $json_payload = false): ?ChatMember
    {
        if(is_array($chat_id)){
            $json_payload = $user_id ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'user_id' => $user_id] + ($args ?? []);
        }
        return $this->APICall('getChatMember', $params ?? [], ChatMember::class, $json_payload);
    }

    /**
     * Use this method to set a new group sticker set for a supergroup.
     * The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
     * Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method.
     * Returns True on success.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param string $sticker_set_name Name of the sticker set to be set as the group sticker set
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function setChatStickerSet($chat_id, $sticker_set_name = null, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $sticker_set_name ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'sticker_set_name' => $sticker_set_name] + ($args ?? []);
        }
        return $this->APICall('setChatStickerSet', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to delete a group sticker set from a supergroup.
     * The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
     * Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method.
     * Returns True on success.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function deleteChatStickerSet($chat_id, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id] + ($args ?? []);
        }
        return $this->APICall('deleteChatStickerSet', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to send answers to callback queries sent from inline keyboards.
     * The answer will be displayed to the user as a notification at the top of the chat screen or as an alert.
     * On success, True is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|string $callback_query_id Method arguments array or Unique identifier for the query to be answered
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function answerCallbackQuery($callback_query_id, $args = null, bool $json_payload = false, ...$kwargs): ?bool
    {
        if(is_array($callback_query_id)){
            $json_payload = $args ?? false; // 2nd param
            $params = $callback_query_id;
        }
        else{
            $params = ['callback_query_id' => $callback_query_id] + ($args ?? []);
        }
        return $this->APICall('answerCallbackQuery', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Use this method to change the list of the bot's commands.
     * See https://core.telegram.org/bots#commands for more details about bot commands.
     * Returns True on success.
     * Arguments can be passed as named arguments.
     *
     * @param array|array $commands Method arguments array or A list of bot commands to be set as the list of the bot's commands. At most 100 commands can be specified.
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function setMyCommands(array $commands = [], $args = null, bool $json_payload = false, ...$kwargs): ?bool
    {
        if(!is_list($commands)){
            $json_payload = $args ?? false; // 2nd param
            $params = $commands;
        }
        else{
            $params = ['commands' => $commands] + ($args ?? []);
        }
        return $this->APICall('setMyCommands', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Use this method to delete the list of the bot's commands for the given scope and user language.
     * After deletion, higher level commands will be shown to affected users.
     * Returns True on success.
     * Arguments can be passed as named arguments.
     *
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function deleteMyCommands($args = null, bool $json_payload = false, ...$kwargs): ?bool
    {
        $params = $args;
        return $this->APICall('deleteMyCommands', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Use this method to get the current list of the bot's commands for the given scope and user language.
     * Returns Array of BotCommand on success.
     * If commands aren't set, an empty list is returned.
     * Arguments can be passed as named arguments.
     *
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return BotCommand[]|ObjectsList|null
     */
    public function getMyCommands($args = null, bool $json_payload = false, ...$kwargs): ?ObjectsList
    {
        $params = $args;
        return $this->APICall('getMyCommands', $kwargs + ($params ?? []), BotCommand::class, $json_payload);
    }

    /**
     * Use this method to edit text and game messages.
     * On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|string $text Method arguments array or New text of the message, 1-4096 characters after entities parsing
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|bool|null
     */
    public function editMessageText($text, $args = null, bool $json_payload = false, ...$kwargs)
    {
        if(is_array($text)){
            $json_payload = $args ?? false; // 2nd param
            $params = $text;
        }
        else{
            $params = ['text' => $text] + ($args ?? []);
        }
        return $this->APICall('editMessageText', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to edit captions of messages.
     * On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
     * Arguments can be passed as named arguments.
     *
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|bool|null
     */
    public function editMessageCaption($args = null, bool $json_payload = false, ...$kwargs)
    {
        $params = $args;
        return $this->APICall('editMessageCaption', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to edit animation, audio, document, photo, or video messages.
     * If a message is part of a message album, then it can be edited only to an audio for audio albums, only to a document for document albums and to a photo or a video otherwise.
     * When an inline message is edited, a new file can't be uploaded; use a previously uploaded file via its file_id or specify a URL.
     * On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
     * Arguments can be passed as named arguments.
     *
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|bool|null
     */
    public function editMessageMedia($args = null, bool $json_payload = false, ...$kwargs)
    {
        $params = $args;
        return $this->APICall('editMessageMedia', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to edit only the reply markup of messages.
     * On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
     * Arguments can be passed as named arguments.
     *
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|bool|null
     */
    public function editMessageReplyMarkup($args = null, bool $json_payload = false, ...$kwargs)
    {
        $params = $args;
        return $this->APICall('editMessageReplyMarkup', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to stop a poll which was sent by the bot.
     * On success, the stopped Poll is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $message_id Identifier of the original message with the poll
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Poll|null
     */
    public function stopPoll($chat_id, $message_id = null, $args = null, bool $json_payload = false, ...$kwargs): ?Poll
    {
        if(is_array($chat_id)){
            $json_payload = $message_id ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'message_id' => $message_id] + ($args ?? []);
        }
        return $this->APICall('stopPoll', $kwargs + ($params ?? []), Poll::class, $json_payload);
    }

    /**
     * Use this method to delete a message, including service messages, with the following limitations:- A message can only be deleted if it was sent less than 48 hours ago.- A dice message in a private chat can only be deleted if it was sent more than 24 hours ago.- Bots can delete outgoing messages in private chats, groups, and supergroups.- Bots can delete incoming messages in private chats.- Bots granted can_post_messages permissions can delete outgoing messages in channels.- If the bot is an administrator of a group, it can delete any message there.- If the bot has can_delete_messages permission in a supergroup or a channel, it can delete any message there.Returns True on success.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $message_id Identifier of the message to delete
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function deleteMessage($chat_id, $message_id = null, bool $json_payload = false): ?bool
    {
        if(is_array($chat_id)){
            $json_payload = $message_id ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'message_id' => $message_id] + ($args ?? []);
        }
        return $this->APICall('deleteMessage', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to send static .WEBP or animated .TGS stickers.
     * On success, the sent Message is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param array|string $sticker Sticker to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a .WEBP file from the Internet, or upload a new one using multipart/form-data. More info on Sending Files »
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|null
     */
    public function sendSticker($chat_id, $sticker = null, $args = null, bool $json_payload = false, ...$kwargs): ?Message
    {
        if(is_array($chat_id)){
            $json_payload = $sticker ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'sticker' => $sticker] + ($args ?? []);
        }
        return $this->APICall('sendSticker', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to get a sticker set.
     * On success, a StickerSet object is returned.
     *
     * @param array|string $name Method arguments array or Name of the sticker set
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return StickerSet|null
     */
    public function getStickerSet($name, bool $json_payload = false): ?StickerSet
    {
        if(is_array($name)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $name;
        }
        else{
            $params = ['name' => $name] + ($args ?? []);
        }
        return $this->APICall('getStickerSet', $params ?? [], StickerSet::class, $json_payload);
    }

    /**
     * Use this method to upload a .PNG file with a sticker for later use in createNewStickerSet and addStickerToSet methods (can be used multiple times).
     * Returns the uploaded File on success.
     *
     * @param array|int $user_id Method arguments array or User identifier of sticker file owner
     * @param array $png_sticker PNG image with the sticker, must be up to 512 kilobytes in size, dimensions must not exceed 512px, and either width or height must be exactly 512px. More info on Sending Files »
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return File|null
     */
    public function uploadStickerFile($user_id, $png_sticker = null, bool $json_payload = false): ?File
    {
        if(is_array($user_id)){
            $json_payload = $png_sticker ?? false; // 2nd param
            $params = $user_id;
        }
        else{
            $params = ['user_id' => $user_id, 'png_sticker' => $png_sticker] + ($args ?? []);
        }
        return $this->APICall('uploadStickerFile', $params ?? [], File::class, $json_payload);
    }

    /**
     * Use this method to create a new sticker set owned by a user.
     * The bot will be able to edit the sticker set thus created.
     * You must use exactly one of the fields png_sticker or tgs_sticker.
     * Returns True on success.
     * Arguments can be passed as named arguments.
     *
     * @param array|int $user_id Method arguments array or User identifier of created sticker set owner
     * @param string $name Short name of sticker set, to be used in t.me/addstickers/ URLs (e.g., animals). Can contain only english letters, digits and underscores. Must begin with a letter, can't contain consecutive underscores and must end in “_by_<bot username>”. <bot_username> is case insensitive. 1-64 characters.
     * @param string $title Sticker set title, 1-64 characters
     * @param string $emojis One or more emoji corresponding to the sticker
     * @param array $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function createNewStickerSet($user_id, $name = null, string $title = null, string $emojis = null, array $args = [], bool $json_payload = false, ...$kwargs): ?bool
    {
        if(is_array($user_id)){
            $json_payload = $name ?? false; // 2nd param
            $params = $user_id;
        }
        else{
            $params = ['user_id' => $user_id, 'name' => $name, 'title' => $title, 'emojis' => $emojis] + ($args ?? []);
        }
        return $this->APICall('createNewStickerSet', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Use this method to add a new sticker to a set created by the bot.
     * You must use exactly one of the fields png_sticker or tgs_sticker.
     * Animated stickers can be added to animated sticker sets and only to them.
     * Animated sticker sets can have up to 50 stickers.
     * Static sticker sets can have up to 120 stickers.
     * Returns True on success.
     * Arguments can be passed as named arguments.
     *
     * @param array|int $user_id Method arguments array or User identifier of sticker set owner
     * @param string $name Sticker set name
     * @param string $emojis One or more emoji corresponding to the sticker
     * @param array $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function addStickerToSet($user_id, $name = null, string $emojis = null, array $args = [], bool $json_payload = false, ...$kwargs): ?bool
    {
        if(is_array($user_id)){
            $json_payload = $name ?? false; // 2nd param
            $params = $user_id;
        }
        else{
            $params = ['user_id' => $user_id, 'name' => $name, 'emojis' => $emojis] + ($args ?? []);
        }
        return $this->APICall('addStickerToSet', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Use this method to move a sticker in a set created by the bot to a specific position.
     * Returns True on success.
     *
     * @param array|string $sticker Method arguments array or File identifier of the sticker
     * @param int $position New sticker position in the set, zero-based
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function setStickerPositionInSet($sticker, $position = null, bool $json_payload = false): ?bool
    {
        if(is_array($sticker)){
            $json_payload = $position ?? false; // 2nd param
            $params = $sticker;
        }
        else{
            $params = ['sticker' => $sticker, 'position' => $position] + ($args ?? []);
        }
        return $this->APICall('setStickerPositionInSet', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to delete a sticker from a set created by the bot.
     * Returns True on success.
     *
     * @param array|string $sticker Method arguments array or File identifier of the sticker
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function deleteStickerFromSet($sticker, bool $json_payload = false): ?bool
    {
        if(is_array($sticker)){
            $json_payload = $json_payload ?? false; // 2nd param
            $params = $sticker;
        }
        else{
            $params = ['sticker' => $sticker] + ($args ?? []);
        }
        return $this->APICall('deleteStickerFromSet', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to set the thumbnail of a sticker set.
     * Animated thumbnails can be set for animated sticker sets only.
     * Returns True on success.
     * Arguments can be passed as named arguments.
     *
     * @param array|string $name Method arguments array or Sticker set name
     * @param int $user_id User identifier of the sticker set owner
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function setStickerSetThumb($name, $user_id = null, $args = null, bool $json_payload = false, ...$kwargs): ?bool
    {
        if(is_array($name)){
            $json_payload = $user_id ?? false; // 2nd param
            $params = $name;
        }
        else{
            $params = ['name' => $name, 'user_id' => $user_id] + ($args ?? []);
        }
        return $this->APICall('setStickerSetThumb', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Use this method to send answers to an inline query.
     * On success, True is returned.No more than 50 results per query are allowed.
     * Arguments can be passed as named arguments.
     *
     * @param array|string $inline_query_id Method arguments array or Unique identifier for the answered query
     * @param array $results An array of results for the inline query
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function answerInlineQuery($inline_query_id, $results = null, $args = null, bool $json_payload = false, ...$kwargs): ?bool
    {
        if(is_array($inline_query_id)){
            $json_payload = $results ?? false; // 2nd param
            $params = $inline_query_id;
        }
        else{
            $params = ['inline_query_id' => $inline_query_id, 'results' => $results] + ($args ?? []);
        }
        return $this->APICall('answerInlineQuery', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Use this method to send invoices.
     * On success, the sent Message is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|int|string $chat_id Method arguments array or Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $title Product name, 1-32 characters
     * @param string $description Product description, 1-255 characters
     * @param string $payload Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for your internal processes.
     * @param string $provider_token Payments provider token, obtained via Botfather
     * @param string $currency Three-letter ISO 4217 currency code, see more on currencies
     * @param array $prices Price breakdown, a JSON-serialized list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.)
     * @param array $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|null
     */
    public function sendInvoice($chat_id, $title = null, string $description = null, string $payload = null, string $provider_token = null, string $currency = null, array $prices = null, array $args = [], bool $json_payload = false, ...$kwargs): ?Message
    {
        if(is_array($chat_id)){
            $json_payload = $title ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'title' => $title, 'description' => $description, 'payload' => $payload, 'provider_token' => $provider_token, 'currency' => $currency, 'prices' => $prices] + ($args ?? []);
        }
        return $this->APICall('sendInvoice', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * If you sent an invoice requesting a shipping address and the parameter is_flexible was specified, the Bot API will send an Update with a shipping_query field to the bot.
     * Use this method to reply to shipping queries.
     * On success, True is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|string $shipping_query_id Method arguments array or Unique identifier for the query to be answered
     * @param bool $ok Specify True if delivery to the specified address is possible and False if there are any problems (for example, if delivery to the specified address is not possible)
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function answerShippingQuery($shipping_query_id, $ok = null, $args = null, bool $json_payload = false, ...$kwargs): ?bool
    {
        if(is_array($shipping_query_id)){
            $json_payload = $ok ?? false; // 2nd param
            $params = $shipping_query_id;
        }
        else{
            $params = ['shipping_query_id' => $shipping_query_id, 'ok' => $ok] + ($args ?? []);
        }
        return $this->APICall('answerShippingQuery', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the form of an Update with the field pre_checkout_query.
     * Use this method to respond to such pre-checkout queries.
     * On success, True is returned.
     * Note: The Bot API must receive an answer within 10 seconds after the pre-checkout query was sent.
     * Arguments can be passed as named arguments.
     *
     * @param array|string $pre_checkout_query_id Method arguments array or Unique identifier for the query to be answered
     * @param bool $ok Specify True if everything is alright (goods are available, etc.) and the bot is ready to proceed with the order. Use False if there are any problems.
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return bool|null
     */
    public function answerPreCheckoutQuery($pre_checkout_query_id, $ok = null, $args = null, bool $json_payload = false, ...$kwargs): ?bool
    {
        if(is_array($pre_checkout_query_id)){
            $json_payload = $ok ?? false; // 2nd param
            $params = $pre_checkout_query_id;
        }
        else{
            $params = ['pre_checkout_query_id' => $pre_checkout_query_id, 'ok' => $ok] + ($args ?? []);
        }
        return $this->APICall('answerPreCheckoutQuery', $kwargs + ($params ?? []), null, $json_payload);
    }

    /**
     * Informs a user that some of the Telegram Passport elements they provided contains errors.
     * The user will not be able to re-submit their Passport to you until the errors are fixed (the contents of the field for which you returned the error must change).
     * Returns True on success.
    Use this if the data submitted by the user doesn't satisfy the standards your service requires for any reason.
     * For example, if a birthday date seems invalid, a submitted document is blurry, a scan shows evidence of tampering, etc.
     * Supply some details in the error message to make sure the user knows how to correct the issues.
     *
     * @param array|int $user_id Method arguments array or User identifier
     * @param array $errors An array describing the errors
     * @param bool $json_payload Whether to use json payload for this method
     *
     * @return bool|null
     */
    public function setPassportDataErrors($user_id, $errors = null, bool $json_payload = false): ?bool
    {
        if(is_array($user_id)){
            $json_payload = $errors ?? false; // 2nd param
            $params = $user_id;
        }
        else{
            $params = ['user_id' => $user_id, 'errors' => $errors] + ($args ?? []);
        }
        return $this->APICall('setPassportDataErrors', $params ?? [], null, $json_payload);
    }

    /**
     * Use this method to send a game.
     * On success, the sent Message is returned.
     * Arguments can be passed as named arguments.
     *
     * @param array|int $chat_id Method arguments array or Unique identifier for the target chat
     * @param string $game_short_name Short name of the game, serves as the unique identifier for the game. Set up your games via Botfather.
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|null
     */
    public function sendGame($chat_id, $game_short_name = null, $args = null, bool $json_payload = false, ...$kwargs): ?Message
    {
        if(is_array($chat_id)){
            $json_payload = $game_short_name ?? false; // 2nd param
            $params = $chat_id;
        }
        else{
            $params = ['chat_id' => $chat_id, 'game_short_name' => $game_short_name] + ($args ?? []);
        }
        return $this->APICall('sendGame', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to set the score of the specified user in a game message.
     * On success, if the message is not an inline message, the Message is returned, otherwise True is returned.
     * Returns an error, if the new score is not greater than the user's current score in the chat and force is False.
     * Arguments can be passed as named arguments.
     *
     * @param array|int $user_id Method arguments array or User identifier
     * @param int $score New score, must be non-negative
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return Message|bool|null
     */
    public function setGameScore($user_id, $score = null, $args = null, bool $json_payload = false, ...$kwargs)
    {
        if(is_array($user_id)){
            $json_payload = $score ?? false; // 2nd param
            $params = $user_id;
        }
        else{
            $params = ['user_id' => $user_id, 'score' => $score] + ($args ?? []);
        }
        return $this->APICall('setGameScore', $kwargs + ($params ?? []), Message::class, $json_payload);
    }

    /**
     * Use this method to get data for high score tables.
     * Will return the score of the specified user and several of their neighbors in a game.
     * On success, returns an Array of GameHighScore objects.
     * Arguments can be passed as named arguments.
     *
     * @param array|int $user_id Method arguments array or Target user id
     * @param mixed $args Other params passed to the method
     * @param bool $json_payload Whether to use json payload for this method
     * @param array ...$kwargs Named arguments
     *
     * @return GameHighScore[]|ObjectsList|null
     */
    public function getGameHighScores($user_id, $args = null, bool $json_payload = false, ...$kwargs): ?ObjectsList
    {
        if(is_array($user_id)){
            $json_payload = $args ?? false; // 2nd param
            $params = $user_id;
        }
        else{
            $params = ['user_id' => $user_id] + ($args ?? []);
        }
        return $this->APICall('getGameHighScores', $kwargs + ($params ?? []), GameHighScore::class, $json_payload);
    }

}
