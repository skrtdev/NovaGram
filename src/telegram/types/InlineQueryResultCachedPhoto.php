<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents a link to a photo stored on the Telegram servers. By default, this photo will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the photo.
*/
class InlineQueryResultCachedPhoto extends \Telegram\InlineQueryResultCachedPhoto{

    /** @var string Type of the result, must be gif */
    public string $type;

    /** @var string Unique identifier for this result, 1-64 bytes */
    public string $id;

    /** @var string A valid file identifier for the GIF file */
    public string $gif_file_id;

    /** @var string|null Title for the result */
    public ?string $title = null;

    /** @var string|null Caption of the GIF file to be sent, 0-1024 characters after entities parsing */
    public ?string $caption = null;

    /** @var string|null Mode for parsing entities in the caption. See formatting options for more details. */
    public ?string $parse_mode = null;

    /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /** @var InputMessageContent|null Content of the message to be sent instead of the GIF animation */
    public ?InputMessageContent $input_message_content = null;

    
}

?>
