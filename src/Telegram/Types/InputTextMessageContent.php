<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Represents the content of a text message to be sent as the result of an inline query.
*/
class InputTextMessageContent extends \Telegram\InputTextMessageContent{

    use simpleProto;

    /** @var string Text of the message to be sent, 1-4096 characters */
    public string $message_text;

    /** @var string|null Mode for parsing entities in the message text. See formatting options for more details. */
    public ?string $parse_mode = null;

    /** @var stdClass|null List of special entities that appear in message text, which can be specified instead of parse_mode */
    public ?stdClass $entities = null;

    /** @var bool|null Disables link previews for links in the sent message */
    public ?bool $disable_web_page_preview = null;

    
}

?>
