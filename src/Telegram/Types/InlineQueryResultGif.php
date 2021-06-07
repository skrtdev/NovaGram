<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents a link to an animated GIF file. By default, this animated GIF file will be sent by the user with optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the animation.
*/
class InlineQueryResultGif extends Type{
    
    protected string $_ = 'InlineQueryResultGif';

    /** @var string Type of the result, must be gif */
    public string $type;

    /** @var string Unique identifier for this result, 1-64 bytes */
    public string $id;

    /** @var string A valid URL for the GIF file. File size must not exceed 1MB */
    public string $gif_url;

    /** @var int|null Width of the GIF */
    public ?int $gif_width = null;

    /** @var int|null Height of the GIF */
    public ?int $gif_height = null;

    /** @var int|null Duration of the GIF */
    public ?int $gif_duration = null;

    /** @var string URL of the static (JPEG or GIF) or animated (MPEG4) thumbnail for the result */
    public string $thumb_url;

    /** @var string|null MIME type of the thumbnail, must be one of “image/jpeg”, “image/gif”, or “video/mp4”. Defaults to “image/jpeg” */
    public ?string $thumb_mime_type = null;

    /** @var string|null Title for the result */
    public ?string $title = null;

    /** @var string|null Caption of the GIF file to be sent, 0-1024 characters after entities parsing */
    public ?string $caption = null;

    /** @var string|null Mode for parsing entities in the caption. See formatting options for more details. */
    public ?string $parse_mode = null;

    /** @var ObjectsList|null List of special entities that appear in the caption, which can be specified instead of parse_mode */
    public ?ObjectsList $caption_entities = null;

    /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /** @var InputMessageContent|null Content of the message to be sent instead of the GIF animation */
    public ?InputMessageContent $input_message_content = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->type = $array['type'];
        $this->id = $array['id'];
        $this->gif_url = $array['gif_url'];
        $this->gif_width = $array['gif_width'] ?? null;
        $this->gif_height = $array['gif_height'] ?? null;
        $this->gif_duration = $array['gif_duration'] ?? null;
        $this->thumb_url = $array['thumb_url'];
        $this->thumb_mime_type = $array['thumb_mime_type'] ?? null;
        $this->title = $array['title'] ?? null;
        $this->caption = $array['caption'] ?? null;
        $this->parse_mode = $array['parse_mode'] ?? null;
        $this->caption_entities = isset($array['caption_entities']) ? new ObjectsList(iterate($array['caption_entities'], fn($item) => new MessageEntity($item, $Bot))) : null;
        $this->reply_markup = isset($array['reply_markup']) ? new InlineKeyboardMarkup($array['reply_markup'], $Bot) : null;
        $this->input_message_content = isset($array['input_message_content']) ? new InputMessageContent($array['input_message_content'], $Bot) : null;
        parent::__construct($array, $Bot);
   }
    
}
