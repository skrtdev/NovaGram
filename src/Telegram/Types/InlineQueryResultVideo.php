<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents a link to a page containing an embedded video player or a video file. By default, this video file will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the video.
*/
class InlineQueryResultVideo extends Type{
    
    protected string $_ = 'InlineQueryResultVideo';

    /** @var string Type of the result, must be video */
    public string $type;

    /** @var string Unique identifier for this result, 1-64 bytes */
    public string $id;

    /** @var string A valid URL for the embedded video player or video file */
    public string $video_url;

    /** @var string Mime type of the content of video url, “text/html” or “video/mp4” */
    public string $mime_type;

    /** @var string URL of the thumbnail (jpeg only) for the video */
    public string $thumb_url;

    /** @var string Title for the result */
    public string $title;

    /** @var string|null Caption of the video to be sent, 0-1024 characters after entities parsing */
    public ?string $caption = null;

    /** @var string|null Mode for parsing entities in the video caption. See formatting options for more details. */
    public ?string $parse_mode = null;

    /** @var ObjectsList|null List of special entities that appear in the caption, which can be specified instead of parse_mode */
    public ?ObjectsList $caption_entities = null;

    /** @var int|null Video width */
    public ?int $video_width = null;

    /** @var int|null Video height */
    public ?int $video_height = null;

    /** @var int|null Video duration in seconds */
    public ?int $video_duration = null;

    /** @var string|null Short description of the result */
    public ?string $description = null;

    /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /** @var InputMessageContent|null Content of the message to be sent instead of the video. This field is required if InlineQueryResultVideo is used to send an HTML-page as a result (e.g., a YouTube video). */
    public ?InputMessageContent $input_message_content = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->type = $array['type'];
        $this->id = $array['id'];
        $this->video_url = $array['video_url'];
        $this->mime_type = $array['mime_type'];
        $this->thumb_url = $array['thumb_url'];
        $this->title = $array['title'];
        $this->caption = $array['caption'] ?? null;
        $this->parse_mode = $array['parse_mode'] ?? null;
        $this->caption_entities = isset($array['caption_entities']) ? new ObjectsList(iterate($array['caption_entities'], fn($item) => new MessageEntity($item, $Bot))) : null;
        $this->video_width = $array['video_width'] ?? null;
        $this->video_height = $array['video_height'] ?? null;
        $this->video_duration = $array['video_duration'] ?? null;
        $this->description = $array['description'] ?? null;
        $this->reply_markup = isset($array['reply_markup']) ? new InlineKeyboardMarkup($array['reply_markup'], $Bot) : null;
        $this->input_message_content = isset($array['input_message_content']) ? new InputMessageContent($array['input_message_content'], $Bot) : null;
        parent::__construct($array, $Bot);
   }
    
}
