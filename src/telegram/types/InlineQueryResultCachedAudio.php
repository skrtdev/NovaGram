<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents a link to an MP3 audio file stored on the Telegram servers. By default, this audio file will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the audio.
*/
class InlineQueryResultCachedAudio extends \Telegram\InlineQueryResultCachedAudio{

    /** @var string Text of the message to be sent, 1-4096 characters */
    public string $message_text;

    /** @var string|null Mode for parsing entities in the message text. See formatting options for more details. */
    public ?string $parse_mode = null;

    /** @var bool|null Disables link previews for links in the sent message */
    public ?bool $disable_web_page_preview = null;

    
}

?>
