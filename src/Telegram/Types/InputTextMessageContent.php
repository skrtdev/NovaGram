<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents the content of a text message to be sent as the result of an inline query.
*/
class InputTextMessageContent extends Type{
    
    /** @var string Text of the message to be sent, 1-4096 characters */
    public string $message_text;

    /** @var string|null Mode for parsing entities in the message text. See formatting options for more details. */
    public ?string $parse_mode = null;

    /** @var ObjectsList|null List of special entities that appear in message text, which can be specified instead of parse_mode */
    public ?ObjectsList $entities = null;

    /** @var bool|null Disables link previews for links in the sent message */
    public ?bool $disable_web_page_preview = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->message_text = $array['message_text'];
        $this->parse_mode = $array['parse_mode'] ?? null;
        $this->entities = isset($array['entities']) ? new ObjectsList(iterate($array['entities'], fn($item) => new MessageEntity($item, $Bot))) : null;
        $this->disable_web_page_preview = $array['disable_web_page_preview'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
