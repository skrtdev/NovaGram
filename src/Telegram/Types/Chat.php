<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\{Bot, conversations, dc};

/**
 * This object represents a chat.
*/
class Chat extends Type{
    
    use dc, conversations;

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

    /** @var bool|null True, if privacy settings of the other party in the private chat allows to use tg://user?id=<user_id> links only in chats with the user. Returned only in getChat. */
    public ?bool $has_private_forwards = null;

    /** @var string|null Description, for groups, supergroups and channel chats. Returned only in getChat. */
    public ?string $description = null;

    /** @var string|null Primary invite link, for groups, supergroups and channel chats. Returned only in getChat. */
    public ?string $invite_link = null;

    /** @var Message|null The most recent pinned message (by sending date). Returned only in getChat. */
    public ?Message $pinned_message = null;

    /** @var ChatPermissions|null Default chat member permissions, for groups and supergroups. Returned only in getChat. */
    public ?ChatPermissions $permissions = null;

    /** @var int|null For supergroups, the minimum allowed delay between consecutive messages sent by each unpriviledged user; in seconds. Returned only in getChat. */
    public ?int $slow_mode_delay = null;

    /** @var int|null The time after which all messages sent to the chat will be automatically deleted; in seconds. Returned only in getChat. */
    public ?int $message_auto_delete_time = null;

    /** @var bool|null True, if messages from the chat can't be forwarded to other chats. Returned only in getChat. */
    public ?bool $has_protected_content = null;

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
        $this->has_private_forwards = $array['has_private_forwards'] ?? null;
        $this->description = $array['description'] ?? null;
        $this->invite_link = $array['invite_link'] ?? null;
        $this->pinned_message = isset($array['pinned_message']) ? new Message($array['pinned_message'], $Bot) : null;
        $this->permissions = isset($array['permissions']) ? new ChatPermissions($array['permissions'], $Bot) : null;
        $this->slow_mode_delay = $array['slow_mode_delay'] ?? null;
        $this->message_auto_delete_time = $array['message_auto_delete_time'] ?? null;
        $this->has_protected_content = $array['has_protected_content'] ?? null;
        $this->sticker_set_name = $array['sticker_set_name'] ?? null;
        $this->can_set_sticker_set = $array['can_set_sticker_set'] ?? null;
        $this->linked_chat_id = $array['linked_chat_id'] ?? null;
        $this->location = isset($array['location']) ? new ChatLocation($array['location'], $Bot) : null;
        parent::__construct($array, $Bot);
    }

    public function isGroup(): bool
    {
        return $this->type === 'group' || $this->type === 'supergroup';
    }

    public function sendMessage($text = null, $parse_mode = null, $entities = null, bool $disable_web_page_preview = null, bool $disable_notification = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, $reply_markup = null, bool $json_payload = false): ?\skrtdev\Telegram\Message
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
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendMessage($params, $json_payload);
    }

    public function forwardTo($from_chat_id = null, $message_id = null, $disable_notification = null, bool $json_payload = false): ?\skrtdev\Telegram\Message
    {
        if(is_array($from_chat_id)){
            $json_payload = $message_id ?? false;
            $params = $from_chat_id;
        }
        else{
            if(is_bool($message_id)){
                $json_payload = $message_id;
                $params = ['from_chat_id' => $from_chat_id];
            }
            elseif(is_array($message_id)){
                $json_payload = $disable_notification ?? false;
                $params = ['from_chat_id' => $from_chat_id] + $message_id;
            }
            else $params = ['from_chat_id' => $from_chat_id, 'message_id' => $message_id, 'disable_notification' => $disable_notification, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->forwardMessage($params, $json_payload);
    }

    public function copyMessage($message_id = null, $caption = null, $parse_mode = null, array $caption_entities = null, bool $disable_notification = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, $reply_markup = null, bool $json_payload = false): ?\skrtdev\Telegram\MessageId
    {
        if(is_array($message_id)){
            $json_payload = $caption ?? false;
            $params = $message_id;
        }
        else{
            if(is_bool($caption)){
                $json_payload = $caption;
                $params = ['message_id' => $message_id];
            }
            elseif(is_array($caption)){
                $json_payload = $parse_mode ?? false;
                $params = ['message_id' => $message_id] + $caption;
            }
            else $params = ['message_id' => $message_id, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'disable_notification' => $disable_notification, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        $params['from_chat_id'] ??= $this->chat->id;
        return $this->Bot->copyMessage($params, $json_payload);
    }

    public function sendPhoto($photo = null, $caption = null, $parse_mode = null, array $caption_entities = null, bool $disable_notification = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, $reply_markup = null, bool $json_payload = false): ?\skrtdev\Telegram\Message
    {
        if(is_array($photo)){
            $json_payload = $caption ?? false;
            $params = $photo;
        }
        else{
            if(is_bool($caption)){
                $json_payload = $caption;
                $params = ['photo' => $photo];
            }
            elseif(is_array($caption)){
                $json_payload = $parse_mode ?? false;
                $params = ['photo' => $photo] + $caption;
            }
            else $params = ['photo' => $photo, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'disable_notification' => $disable_notification, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendPhoto($params, $json_payload);
    }

    public function sendDocument($document = null, $thumb = null, $caption = null, string $parse_mode = null, array $caption_entities = null, bool $disable_content_type_detection = null, bool $disable_notification = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, $reply_markup = null, bool $json_payload = false): ?\skrtdev\Telegram\Message
    {
        if(is_array($document)){
            $json_payload = $thumb ?? false;
            $params = $document;
        }
        else{
            if(is_bool($thumb)){
                $json_payload = $thumb;
                $params = ['document' => $document];
            }
            elseif(is_array($thumb)){
                $json_payload = $caption ?? false;
                $params = ['document' => $document] + $thumb;
            }
            else $params = ['document' => $document, 'thumb' => $thumb, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'disable_content_type_detection' => $disable_content_type_detection, 'disable_notification' => $disable_notification, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendDocument($params, $json_payload);
    }

    public function sendVideo($video = null, $duration = null, $width = null, int $height = null, $thumb = null, string $caption = null, string $parse_mode = null, array $caption_entities = null, bool $supports_streaming = null, bool $disable_notification = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, $reply_markup = null, bool $json_payload = false): ?\skrtdev\Telegram\Message
    {
        if(is_array($video)){
            $json_payload = $duration ?? false;
            $params = $video;
        }
        else{
            if(is_bool($duration)){
                $json_payload = $duration;
                $params = ['video' => $video];
            }
            elseif(is_array($duration)){
                $json_payload = $width ?? false;
                $params = ['video' => $video] + $duration;
            }
            else $params = ['video' => $video, 'duration' => $duration, 'width' => $width, 'height' => $height, 'thumb' => $thumb, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'supports_streaming' => $supports_streaming, 'disable_notification' => $disable_notification, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendVideo($params, $json_payload);
    }

    public function sendAnimation($animation = null, $duration = null, $width = null, int $height = null, $thumb = null, string $caption = null, string $parse_mode = null, array $caption_entities = null, bool $disable_notification = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, $reply_markup = null, bool $json_payload = false): ?\skrtdev\Telegram\Message
    {
        if(is_array($animation)){
            $json_payload = $duration ?? false;
            $params = $animation;
        }
        else{
            if(is_bool($duration)){
                $json_payload = $duration;
                $params = ['animation' => $animation];
            }
            elseif(is_array($duration)){
                $json_payload = $width ?? false;
                $params = ['animation' => $animation] + $duration;
            }
            else $params = ['animation' => $animation, 'duration' => $duration, 'width' => $width, 'height' => $height, 'thumb' => $thumb, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'disable_notification' => $disable_notification, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendAnimation($params, $json_payload);
    }

    public function sendVoice($voice = null, $caption = null, $parse_mode = null, array $caption_entities = null, int $duration = null, bool $disable_notification = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, $reply_markup = null, bool $json_payload = false): ?\skrtdev\Telegram\Message
    {
        if(is_array($voice)){
            $json_payload = $caption ?? false;
            $params = $voice;
        }
        else{
            if(is_bool($caption)){
                $json_payload = $caption;
                $params = ['voice' => $voice];
            }
            elseif(is_array($caption)){
                $json_payload = $parse_mode ?? false;
                $params = ['voice' => $voice] + $caption;
            }
            else $params = ['voice' => $voice, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'duration' => $duration, 'disable_notification' => $disable_notification, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendVoice($params, $json_payload);
    }

    public function sendVideoNote($video_note = null, $duration = null, $length = null, $thumb = null, bool $disable_notification = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, $reply_markup = null, bool $json_payload = false): ?\skrtdev\Telegram\Message
    {
        if(is_array($video_note)){
            $json_payload = $duration ?? false;
            $params = $video_note;
        }
        else{
            if(is_bool($duration)){
                $json_payload = $duration;
                $params = ['video_note' => $video_note];
            }
            elseif(is_array($duration)){
                $json_payload = $length ?? false;
                $params = ['video_note' => $video_note] + $duration;
            }
            else $params = ['video_note' => $video_note, 'duration' => $duration, 'length' => $length, 'thumb' => $thumb, 'disable_notification' => $disable_notification, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendVideoNote($params, $json_payload);
    }

    public function sendMediaGroup($media = null, $disable_notification = null, $reply_to_message_id = null, bool $allow_sending_without_reply = null, bool $json_payload = false): ?ObjectsList
    {
        if(is_array($media)){
            $json_payload = $disable_notification ?? false;
            $params = $media;
        }
        else{
            if(is_bool($disable_notification)){
                $json_payload = $disable_notification;
                $params = ['media' => $media];
            }
            elseif(is_array($disable_notification)){
                $json_payload = $reply_to_message_id ?? false;
                $params = ['media' => $media] + $disable_notification;
            }
            else $params = ['media' => $media, 'disable_notification' => $disable_notification, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendMediaGroup($params, $json_payload);
    }

    public function sendLocation($latitude = null, $longitude = null, $horizontal_accuracy = null, int $live_period = null, int $heading = null, int $proximity_alert_radius = null, bool $disable_notification = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, $reply_markup = null, bool $json_payload = false): ?\skrtdev\Telegram\Message
    {
        if(is_array($latitude)){
            $json_payload = $longitude ?? false;
            $params = $latitude;
        }
        else{
            if(is_bool($longitude)){
                $json_payload = $longitude;
                $params = ['latitude' => $latitude];
            }
            elseif(is_array($longitude)){
                $json_payload = $horizontal_accuracy ?? false;
                $params = ['latitude' => $latitude] + $longitude;
            }
            else $params = ['latitude' => $latitude, 'longitude' => $longitude, 'horizontal_accuracy' => $horizontal_accuracy, 'live_period' => $live_period, 'heading' => $heading, 'proximity_alert_radius' => $proximity_alert_radius, 'disable_notification' => $disable_notification, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendLocation($params, $json_payload);
    }

    public function editMessageLiveLocation($latitude = null, $longitude = null, $message_id = null, string $inline_message_id = null, float $horizontal_accuracy = null, int $heading = null, int $proximity_alert_radius = null, array $reply_markup = null, bool $json_payload = false)
    {
        if(is_array($latitude)){
            $json_payload = $longitude ?? false;
            $params = $latitude;
        }
        else{
            if(is_bool($longitude)){
                $json_payload = $longitude;
                $params = ['latitude' => $latitude];
            }
            elseif(is_array($longitude)){
                $json_payload = $message_id ?? false;
                $params = ['latitude' => $latitude] + $longitude;
            }
            else $params = ['latitude' => $latitude, 'longitude' => $longitude, 'message_id' => $message_id, 'inline_message_id' => $inline_message_id, 'horizontal_accuracy' => $horizontal_accuracy, 'heading' => $heading, 'proximity_alert_radius' => $proximity_alert_radius, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->editMessageLiveLocation($params, $json_payload);
    }

    public function stopMessageLiveLocation($message_id = null, $inline_message_id = null, $reply_markup = null, bool $json_payload = false)
    {
        if(is_array($message_id)){
            $json_payload = $inline_message_id ?? false;
            $params = $message_id;
        }
        else{
            if(is_bool($inline_message_id)){
                $json_payload = $inline_message_id;
                $params = ['message_id' => $message_id];
            }
            elseif(is_array($inline_message_id)){
                $json_payload = $reply_markup ?? false;
                $params = ['message_id' => $message_id] + $inline_message_id;
            }
            else $params = ['message_id' => $message_id, 'inline_message_id' => $inline_message_id, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->stopMessageLiveLocation($params, $json_payload);
    }

    public function sendVenue($latitude = null, $longitude = null, $title = null, string $address = null, string $foursquare_id = null, string $foursquare_type = null, string $google_place_id = null, string $google_place_type = null, bool $disable_notification = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, $reply_markup = null, bool $json_payload = false): ?\skrtdev\Telegram\Message
    {
        if(is_array($latitude)){
            $json_payload = $longitude ?? false;
            $params = $latitude;
        }
        else{
            if(is_bool($longitude)){
                $json_payload = $longitude;
                $params = ['latitude' => $latitude];
            }
            elseif(is_array($longitude)){
                $json_payload = $title ?? false;
                $params = ['latitude' => $latitude] + $longitude;
            }
            else $params = ['latitude' => $latitude, 'longitude' => $longitude, 'title' => $title, 'address' => $address, 'foursquare_id' => $foursquare_id, 'foursquare_type' => $foursquare_type, 'google_place_id' => $google_place_id, 'google_place_type' => $google_place_type, 'disable_notification' => $disable_notification, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendVenue($params, $json_payload);
    }

    public function sendContact($phone_number = null, $first_name = null, $last_name = null, string $vcard = null, bool $disable_notification = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, $reply_markup = null, bool $json_payload = false): ?\skrtdev\Telegram\Message
    {
        if(is_array($phone_number)){
            $json_payload = $first_name ?? false;
            $params = $phone_number;
        }
        else{
            if(is_bool($first_name)){
                $json_payload = $first_name;
                $params = ['phone_number' => $phone_number];
            }
            elseif(is_array($first_name)){
                $json_payload = $last_name ?? false;
                $params = ['phone_number' => $phone_number] + $first_name;
            }
            else $params = ['phone_number' => $phone_number, 'first_name' => $first_name, 'last_name' => $last_name, 'vcard' => $vcard, 'disable_notification' => $disable_notification, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendContact($params, $json_payload);
    }

    public function sendPoll($question = null, $options = null, $is_anonymous = null, string $type = null, bool $allows_multiple_answers = null, int $correct_option_id = null, string $explanation = null, string $explanation_parse_mode = null, array $explanation_entities = null, int $open_period = null, int $close_date = null, bool $is_closed = null, bool $disable_notification = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, $reply_markup = null, bool $json_payload = false): ?\skrtdev\Telegram\Message
    {
        if(is_array($question)){
            $json_payload = $options ?? false;
            $params = $question;
        }
        else{
            if(is_bool($options)){
                $json_payload = $options;
                $params = ['question' => $question];
            }
            elseif(is_array($options)){
                $json_payload = $is_anonymous ?? false;
                $params = ['question' => $question] + $options;
            }
            else $params = ['question' => $question, 'options' => $options, 'is_anonymous' => $is_anonymous, 'type' => $type, 'allows_multiple_answers' => $allows_multiple_answers, 'correct_option_id' => $correct_option_id, 'explanation' => $explanation, 'explanation_parse_mode' => $explanation_parse_mode, 'explanation_entities' => $explanation_entities, 'open_period' => $open_period, 'close_date' => $close_date, 'is_closed' => $is_closed, 'disable_notification' => $disable_notification, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendPoll($params, $json_payload);
    }

    public function sendDice($emoji = null, $disable_notification = null, $reply_to_message_id = null, bool $allow_sending_without_reply = null, $reply_markup = null, bool $json_payload = false): ?\skrtdev\Telegram\Message
    {
        if(is_array($emoji)){
            $json_payload = $disable_notification ?? false;
            $params = $emoji;
        }
        else{
            if(is_bool($disable_notification)){
                $json_payload = $disable_notification;
                $params = ['emoji' => $emoji];
            }
            elseif(is_array($disable_notification)){
                $json_payload = $reply_to_message_id ?? false;
                $params = ['emoji' => $emoji] + $disable_notification;
            }
            else $params = ['emoji' => $emoji, 'disable_notification' => $disable_notification, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendDice($params, $json_payload);
    }

    public function sendAction($action = null, bool $json_payload = false): ?bool
    {
        if(is_array($action)){
            $json_payload = $json_payload ?? false;
            $params = $action;
        }
        else{
            $params = ['action' => $action, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendChatAction($params, $json_payload);
    }

    public function banMember($user_id = null, $until_date = null, $revoke_messages = null, bool $json_payload = false): ?bool
    {
        if(is_array($user_id)){
            $json_payload = $until_date ?? false;
            $params = $user_id;
        }
        else{
            if(is_bool($until_date)){
                $json_payload = $until_date;
                $params = ['user_id' => $user_id];
            }
            elseif(is_array($until_date)){
                $json_payload = $revoke_messages ?? false;
                $params = ['user_id' => $user_id] + $until_date;
            }
            else $params = ['user_id' => $user_id, 'until_date' => $until_date, 'revoke_messages' => $revoke_messages, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->banChatMember($params, $json_payload);
    }

    public function unbanMember($user_id = null, $only_if_banned = null, bool $json_payload = false): ?bool
    {
        if(is_array($user_id)){
            $json_payload = $only_if_banned ?? false;
            $params = $user_id;
        }
        else{
            if(is_bool($only_if_banned)){
                $json_payload = $only_if_banned;
                $params = ['user_id' => $user_id];
            }
            elseif(is_array($only_if_banned)){
                $json_payload = $json_payload ?? false;
                $params = ['user_id' => $user_id] + $only_if_banned;
            }
            else $params = ['user_id' => $user_id, 'only_if_banned' => $only_if_banned, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->unbanChatMember($params, $json_payload);
    }

    public function restrictMember($user_id = null, $permissions = null, $until_date = null, bool $json_payload = false): ?bool
    {
        if(is_array($user_id)){
            $json_payload = $permissions ?? false;
            $params = $user_id;
        }
        else{
            if(is_bool($permissions)){
                $json_payload = $permissions;
                $params = ['user_id' => $user_id];
            }
            elseif(is_array($permissions)){
                $json_payload = $until_date ?? false;
                $params = ['user_id' => $user_id] + $permissions;
            }
            else $params = ['user_id' => $user_id, 'permissions' => $permissions, 'until_date' => $until_date, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->restrictChatMember($params, $json_payload);
    }

    public function promoteMember($user_id = null, $is_anonymous = null, $can_manage_chat = null, bool $can_post_messages = null, bool $can_edit_messages = null, bool $can_delete_messages = null, bool $can_manage_voice_chats = null, bool $can_restrict_members = null, bool $can_promote_members = null, bool $can_change_info = null, bool $can_invite_users = null, bool $can_pin_messages = null, bool $json_payload = false): ?bool
    {
        if(is_array($user_id)){
            $json_payload = $is_anonymous ?? false;
            $params = $user_id;
        }
        else{
            if(is_bool($is_anonymous)){
                $json_payload = $is_anonymous;
                $params = ['user_id' => $user_id];
            }
            elseif(is_array($is_anonymous)){
                $json_payload = $can_manage_chat ?? false;
                $params = ['user_id' => $user_id] + $is_anonymous;
            }
            else $params = ['user_id' => $user_id, 'is_anonymous' => $is_anonymous, 'can_manage_chat' => $can_manage_chat, 'can_post_messages' => $can_post_messages, 'can_edit_messages' => $can_edit_messages, 'can_delete_messages' => $can_delete_messages, 'can_manage_voice_chats' => $can_manage_voice_chats, 'can_restrict_members' => $can_restrict_members, 'can_promote_members' => $can_promote_members, 'can_change_info' => $can_change_info, 'can_invite_users' => $can_invite_users, 'can_pin_messages' => $can_pin_messages, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->promoteChatMember($params, $json_payload);
    }

    public function setAdministratorCustomTitle($user_id = null, $custom_title = null, bool $json_payload = false): ?bool
    {
        if(is_array($user_id)){
            $json_payload = $custom_title ?? false;
            $params = $user_id;
        }
        else{
            if(is_bool($custom_title)){
                $json_payload = $custom_title;
                $params = ['user_id' => $user_id];
            }
            elseif(is_array($custom_title)){
                $json_payload = $json_payload ?? false;
                $params = ['user_id' => $user_id] + $custom_title;
            }
            else $params = ['user_id' => $user_id, 'custom_title' => $custom_title, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->setChatAdministratorCustomTitle($params, $json_payload);
    }

    public function setPermissions($permissions = null, bool $json_payload = false): ?bool
    {
        if(is_array($permissions)){
            $json_payload = $json_payload ?? false;
            $params = $permissions;
        }
        else{
            $params = ['permissions' => $permissions, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->setChatPermissions($params, $json_payload);
    }

    public function exportInviteLink(bool $json_payload = false): ?string
    {
        return $this->Bot->exportChatInviteLink(['chat_id' => $this->id], $json_payload);
    }

    public function setPhoto($photo = null, bool $json_payload = false): ?bool
    {
        if(is_array($photo)){
            $json_payload = $json_payload ?? false;
            $params = $photo;
        }
        else{
            $params = ['photo' => $photo, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->setChatPhoto($params, $json_payload);
    }

    public function deletePhoto(bool $json_payload = false): ?bool
    {
        return $this->Bot->deleteChatPhoto(['chat_id' => $this->id], $json_payload);
    }

    public function setTitle($title = null, bool $json_payload = false): ?bool
    {
        if(is_array($title)){
            $json_payload = $json_payload ?? false;
            $params = $title;
        }
        else{
            $params = ['title' => $title, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->setChatTitle($params, $json_payload);
    }

    public function setDescription($description = null, bool $json_payload = false): ?bool
    {
        if(is_array($description)){
            $json_payload = $json_payload ?? false;
            $params = $description;
        }
        else{
            $params = ['description' => $description, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->setChatDescription($params, $json_payload);
    }

    public function pinMessage($message_id = null, $disable_notification = null, bool $json_payload = false): ?bool
    {
        if(is_array($message_id)){
            $json_payload = $disable_notification ?? false;
            $params = $message_id;
        }
        else{
            if(is_bool($disable_notification)){
                $json_payload = $disable_notification;
                $params = ['message_id' => $message_id];
            }
            elseif(is_array($disable_notification)){
                $json_payload = $json_payload ?? false;
                $params = ['message_id' => $message_id] + $disable_notification;
            }
            else $params = ['message_id' => $message_id, 'disable_notification' => $disable_notification, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->pinChatMessage($params, $json_payload);
    }

    public function unpinMessage($message_id = null, bool $json_payload = false): ?bool
    {
        if(is_array($message_id)){
            $json_payload = $json_payload ?? false;
            $params = $message_id;
        }
        else{
            $params = ['message_id' => $message_id, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->unpinChatMessage($params, $json_payload);
    }

    public function unpinAllMessages(bool $json_payload = false): ?bool
    {
        return $this->Bot->unpinAllChatMessages(['chat_id' => $this->id], $json_payload);
    }

    public function leave(bool $json_payload = false): ?bool
    {
        return $this->Bot->leaveChat(['chat_id' => $this->id], $json_payload);
    }

    public function get(bool $json_payload = false): ?\skrtdev\Telegram\Chat
    {
        return $this->Bot->getChat(['chat_id' => $this->id], $json_payload);
    }

    public function getAdministrators(): ?ObjectsList
    {
        return $this->Bot->getChatAdministrators(['chat_id' => $this->id]);
    }

    public function getMember($user_id = null, bool $json_payload = false): ?\skrtdev\Telegram\ChatMember
    {
        if(is_array($user_id)){
            $json_payload = $json_payload ?? false;
            $params = $user_id;
        }
        else{
            $params = ['user_id' => $user_id, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->getChatMember($params, $json_payload);
    }

    public function setStickerSet($sticker_set_name = null, bool $json_payload = false): ?bool
    {
        if(is_array($sticker_set_name)){
            $json_payload = $json_payload ?? false;
            $params = $sticker_set_name;
        }
        else{
            $params = ['sticker_set_name' => $sticker_set_name, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->setChatStickerSet($params, $json_payload);
    }

    public function deleteStickerSet(bool $json_payload = false): ?bool
    {
        return $this->Bot->deleteChatStickerSet(['chat_id' => $this->id], $json_payload);
    }

    public function editMessageText($text = null, $message_id = null, $inline_message_id = null, string $parse_mode = null, array $entities = null, bool $disable_web_page_preview = null, array $reply_markup = null, bool $json_payload = false)
    {
        if(is_array($text)){
            $json_payload = $message_id ?? false;
            $params = $text;
        }
        else{
            if(is_bool($message_id)){
                $json_payload = $message_id;
                $params = ['text' => $text];
            }
            elseif(is_array($message_id)){
                $json_payload = $inline_message_id ?? false;
                $params = ['text' => $text] + $message_id;
            }
            else $params = ['text' => $text, 'message_id' => $message_id, 'inline_message_id' => $inline_message_id, 'parse_mode' => $parse_mode, 'entities' => $entities, 'disable_web_page_preview' => $disable_web_page_preview, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->editMessageText($params, $json_payload);
    }

    public function editMessageCaption($message_id = null, $inline_message_id = null, $caption = null, string $parse_mode = null, array $caption_entities = null, array $reply_markup = null, bool $json_payload = false)
    {
        if(is_array($message_id)){
            $json_payload = $inline_message_id ?? false;
            $params = $message_id;
        }
        else{
            if(is_bool($inline_message_id)){
                $json_payload = $inline_message_id;
                $params = ['message_id' => $message_id];
            }
            elseif(is_array($inline_message_id)){
                $json_payload = $caption ?? false;
                $params = ['message_id' => $message_id] + $inline_message_id;
            }
            else $params = ['message_id' => $message_id, 'inline_message_id' => $inline_message_id, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->editMessageCaption($params, $json_payload);
    }

    public function editMessageMedia($media = null, $message_id = null, $inline_message_id = null, array $reply_markup = null, bool $json_payload = false)
    {
        if(is_array($media)){
            $json_payload = $message_id ?? false;
            $params = $media;
        }
        else{
            if(is_bool($message_id)){
                $json_payload = $message_id;
                $params = ['media' => $media];
            }
            elseif(is_array($message_id)){
                $json_payload = $inline_message_id ?? false;
                $params = ['media' => $media] + $message_id;
            }
            else $params = ['media' => $media, 'message_id' => $message_id, 'inline_message_id' => $inline_message_id, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->editMessageMedia($params, $json_payload);
    }

    public function editMessageReplyMarkup($message_id = null, $inline_message_id = null, $reply_markup = null, bool $json_payload = false)
    {
        if(is_array($message_id)){
            $json_payload = $inline_message_id ?? false;
            $params = $message_id;
        }
        else{
            if(is_bool($inline_message_id)){
                $json_payload = $inline_message_id;
                $params = ['message_id' => $message_id];
            }
            elseif(is_array($inline_message_id)){
                $json_payload = $reply_markup ?? false;
                $params = ['message_id' => $message_id] + $inline_message_id;
            }
            else $params = ['message_id' => $message_id, 'inline_message_id' => $inline_message_id, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->editMessageReplyMarkup($params, $json_payload);
    }

    public function stopPoll($message_id = null, $reply_markup = null, bool $json_payload = false): ?\skrtdev\Telegram\Poll
    {
        if(is_array($message_id)){
            $json_payload = $reply_markup ?? false;
            $params = $message_id;
        }
        else{
            if(is_bool($reply_markup)){
                $json_payload = $reply_markup;
                $params = ['message_id' => $message_id];
            }
            elseif(is_array($reply_markup)){
                $json_payload = $json_payload ?? false;
                $params = ['message_id' => $message_id] + $reply_markup;
            }
            else $params = ['message_id' => $message_id, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->stopPoll($params, $json_payload);
    }

    public function deleteMessage($message_id = null, bool $json_payload = false): ?bool
    {
        if(is_array($message_id)){
            $json_payload = $json_payload ?? false;
            $params = $message_id;
        }
        else{
            $params = ['message_id' => $message_id, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->deleteMessage($params, $json_payload);
    }

    public function sendSticker($sticker = null, $disable_notification = null, $reply_to_message_id = null, bool $allow_sending_without_reply = null, $reply_markup = null, bool $json_payload = false): ?\skrtdev\Telegram\Message
    {
        if(is_array($sticker)){
            $json_payload = $disable_notification ?? false;
            $params = $sticker;
        }
        else{
            if(is_bool($disable_notification)){
                $json_payload = $disable_notification;
                $params = ['sticker' => $sticker];
            }
            elseif(is_array($disable_notification)){
                $json_payload = $reply_to_message_id ?? false;
                $params = ['sticker' => $sticker] + $disable_notification;
            }
            else $params = ['sticker' => $sticker, 'disable_notification' => $disable_notification, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendSticker($params, $json_payload);
    }

    public function sendInvoice($title = null, $description = null, $payload = null, string $provider_token = null, string $currency = null, array $prices = null, int $max_tip_amount = null, array $suggested_tip_amounts = null, string $start_parameter = null, string $provider_data = null, string $photo_url = null, int $photo_size = null, int $photo_width = null, int $photo_height = null, bool $need_name = null, bool $need_phone_number = null, bool $need_email = null, bool $need_shipping_address = null, bool $send_phone_number_to_provider = null, bool $send_email_to_provider = null, bool $is_flexible = null, bool $disable_notification = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, array $reply_markup = null, bool $json_payload = false): ?\skrtdev\Telegram\Message
    {
        if(is_array($title)){
            $json_payload = $description ?? false;
            $params = $title;
        }
        else{
            if(is_bool($description)){
                $json_payload = $description;
                $params = ['title' => $title];
            }
            elseif(is_array($description)){
                $json_payload = $payload ?? false;
                $params = ['title' => $title] + $description;
            }
            else $params = ['title' => $title, 'description' => $description, 'payload' => $payload, 'provider_token' => $provider_token, 'currency' => $currency, 'prices' => $prices, 'max_tip_amount' => $max_tip_amount, 'suggested_tip_amounts' => $suggested_tip_amounts, 'start_parameter' => $start_parameter, 'provider_data' => $provider_data, 'photo_url' => $photo_url, 'photo_size' => $photo_size, 'photo_width' => $photo_width, 'photo_height' => $photo_height, 'need_name' => $need_name, 'need_phone_number' => $need_phone_number, 'need_email' => $need_email, 'need_shipping_address' => $need_shipping_address, 'send_phone_number_to_provider' => $send_phone_number_to_provider, 'send_email_to_provider' => $send_email_to_provider, 'is_flexible' => $is_flexible, 'disable_notification' => $disable_notification, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendInvoice($params, $json_payload);
    }

    public function sendGame($game_short_name = null, $disable_notification = null, $reply_to_message_id = null, bool $allow_sending_without_reply = null, array $reply_markup = null, bool $json_payload = false): ?\skrtdev\Telegram\Message
    {
        if(is_array($game_short_name)){
            $json_payload = $disable_notification ?? false;
            $params = $game_short_name;
        }
        else{
            if(is_bool($disable_notification)){
                $json_payload = $disable_notification;
                $params = ['game_short_name' => $game_short_name];
            }
            elseif(is_array($disable_notification)){
                $json_payload = $reply_to_message_id ?? false;
                $params = ['game_short_name' => $game_short_name] + $disable_notification;
            }
            else $params = ['game_short_name' => $game_short_name, 'disable_notification' => $disable_notification, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->sendGame($params, $json_payload);
    }

    public function setGameScore($user_id = null, $score = null, $force = null, bool $disable_edit_message = null, int $message_id = null, string $inline_message_id = null, bool $json_payload = false)
    {
        if(is_array($user_id)){
            $json_payload = $score ?? false;
            $params = $user_id;
        }
        else{
            if(is_bool($score)){
                $json_payload = $score;
                $params = ['user_id' => $user_id];
            }
            elseif(is_array($score)){
                $json_payload = $force ?? false;
                $params = ['user_id' => $user_id] + $score;
            }
            else $params = ['user_id' => $user_id, 'score' => $score, 'force' => $force, 'disable_edit_message' => $disable_edit_message, 'message_id' => $message_id, 'inline_message_id' => $inline_message_id, 'json_payload' => $json_payload];
        }
        $params['chat_id'] ??= $this->id;
        return $this->Bot->setGameScore($params, $json_payload);
    }
}
