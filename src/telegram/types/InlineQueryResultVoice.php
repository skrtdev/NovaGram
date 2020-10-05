<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents a link to a voice recording in an .OGG container encoded with OPUS. By default, this voice recording will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the the voice message.
*/
class InlineQueryResultVoice extends \Telegram\InlineQueryResultVoice{

    /** @var string Type of the result, must be document */
    public string $type;

    /** @var string Unique identifier for this result, 1-64 bytes */
    public string $id;

    /** @var string Title for the result */
    public string $title;

    /** @var string|null Caption of the document to be sent, 0-1024 characters after entities parsing */
    public ?string $caption = null;

    /** @var string|null Mode for parsing entities in the document caption. See formatting options for more details. */
    public ?string $parse_mode = null;

    /** @var string A valid URL for the file */
    public string $document_url;

    /** @var string Mime type of the content of the file, either “application/pdf” or “application/zip” */
    public string $mime_type;

    /** @var string|null Short description of the result */
    public ?string $description = null;

    /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /** @var InputMessageContent|null Content of the message to be sent instead of the file */
    public ?InputMessageContent $input_message_content = null;

    /** @var string|null URL of the thumbnail (jpeg only) for the file */
    public ?string $thumb_url = null;

    /** @var int|null Thumbnail width */
    public ?int $thumb_width = null;

    /** @var int|null Thumbnail height */
    public ?int $thumb_height = null;

    
}

?>
