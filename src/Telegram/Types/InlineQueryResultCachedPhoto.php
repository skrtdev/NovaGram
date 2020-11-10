<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Represents a link to a photo stored on the Telegram servers. By default, this photo will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the photo.
*/
class InlineQueryResultCachedPhoto extends \Telegram\InlineQueryResultCachedPhoto{

    use simpleProto;

    /** @var string Type of the result, must be photo */
    public string $type;

    /** @var string Unique identifier for this result, 1-64 bytes */
    public string $id;

    /** @var string A valid file identifier of the photo */
    public string $photo_file_id;

    /** @var string|null Title for the result */
    public ?string $title = null;

    /** @var string|null Short description of the result */
    public ?string $description = null;

    /** @var string|null Caption of the photo to be sent, 0-1024 characters after entities parsing */
    public ?string $caption = null;

    /** @var string|null Mode for parsing entities in the photo caption. See formatting options for more details. */
    public ?string $parse_mode = null;

    /** @var stdClass|null List of special entities that appear in the caption, which can be specified instead of parse_mode */
    public ?stdClass $caption_entities = null;

    /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /** @var InputMessageContent|null Content of the message to be sent instead of the photo */
    public ?InputMessageContent $input_message_content = null;

    
}

?>
