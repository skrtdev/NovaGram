<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Represents a link to an MP3 audio file. By default, this audio file will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the audio.
*/
class InlineQueryResultAudio extends \Telegram\InlineQueryResultAudio{

    use simpleProto;

    /** @var string Type of the result, must be audio */
    public string $type;

    /** @var string Unique identifier for this result, 1-64 bytes */
    public string $id;

    /** @var string A valid URL for the audio file */
    public string $audio_url;

    /** @var string Title */
    public string $title;

    /** @var string|null Caption, 0-1024 characters after entities parsing */
    public ?string $caption = null;

    /** @var string|null Mode for parsing entities in the audio caption. See formatting options for more details. */
    public ?string $parse_mode = null;

    /** @var stdClass|null List of special entities that appear in the caption, which can be specified instead of parse_mode */
    public ?stdClass $caption_entities = null;

    /** @var string|null Performer */
    public ?string $performer = null;

    /** @var int|null Audio duration in seconds */
    public ?int $audio_duration = null;

    /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
    public ?InlineKeyboardMarkup $reply_markup = null;

    /** @var InputMessageContent|null Content of the message to be sent instead of the audio */
    public ?InputMessageContent $input_message_content = null;

    
}

?>
