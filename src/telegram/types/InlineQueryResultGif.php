<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Represents a link to an animated GIF file. By default, this animated GIF file will be sent by the user with optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the animation.
*/
class InlineQueryResultGif extends \Telegram\InlineQueryResultGif{

    use simpleProto;

    /** @var string Type of the result, must be mpeg4_gif */
    public string $type;

    /** @var string Unique identifier for this result, 1-64 bytes */
    public string $id;

    /** @var string A valid URL for the MP4 file. File size must not exceed 1MB */
    public string $mpeg4_url;

    /** @var int|null Video width */
    public ?int $mpeg4_width = null;

    /** @var int|null Video height */
    public ?int $mpeg4_height = null;

    /** @var int|null Video duration */
    public ?int $mpeg4_duration = null;

    /** @var string URL of the static (JPEG or GIF) or animated (MPEG4) thumbnail for the result */
    public string $thumb_url;

    /** @var string|null MIME type of the thumbnail, must be one of “image/jpeg”, “image/gif”, or “video/mp4”. Defaults to “image/jpeg” */
    public ?string $thumb_mime_type = null;

    /** @var string|null Title for the result */
    public ?string $title = null;

    /** @var string|null Caption of the MPEG-4 file to be sent, 0-1024 characters after entities parsing */
    public ?string $caption = null;

    /** @var string|null Mode for parsing entities in the caption. See formatting options for more details. */
    public ?string $parse_mode = null;

    /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /** @var InputMessageContent|null Content of the message to be sent instead of the video animation */
    public ?InputMessageContent $input_message_content = null;

    
}

?>
