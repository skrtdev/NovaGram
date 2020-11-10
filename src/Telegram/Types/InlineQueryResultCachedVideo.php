<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Represents a link to a video file stored on the Telegram servers. By default, this video file will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the video.
*/
class InlineQueryResultCachedVideo extends \Telegram\InlineQueryResultCachedVideo{

    use simpleProto;

    /** @var string Type of the result, must be video */
    public string $type;

    /** @var string Unique identifier for this result, 1-64 bytes */
    public string $id;

    /** @var string A valid file identifier for the video file */
    public string $video_file_id;

    /** @var string Title for the result */
    public string $title;

    /** @var string|null Short description of the result */
    public ?string $description = null;

    /** @var string|null Caption of the video to be sent, 0-1024 characters after entities parsing */
    public ?string $caption = null;

    /** @var string|null Mode for parsing entities in the video caption. See formatting options for more details. */
    public ?string $parse_mode = null;

    /** @var stdClass|null List of special entities that appear in the caption, which can be specified instead of parse_mode */
    public ?stdClass $caption_entities = null;

    /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /** @var InputMessageContent|null Content of the message to be sent instead of the video */
    public ?InputMessageContent $input_message_content = null;

    
}

?>
