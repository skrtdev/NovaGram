<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
*/
class MessageEntity extends Type{
    
    /** @var string Type of the entity. Can be “mention” (@username), “hashtag” (#hashtag), “cashtag” ($USD), “bot_command” (/start@jobs_bot), “url” (https://telegram.org), “email” (do-not-reply@telegram.org), “phone_number” (+1-212-555-0123), “bold” (bold text), “italic” (italic text), “underline” (underlined text), “strikethrough” (strikethrough text), “code” (monowidth string), “pre” (monowidth block), “text_link” (for clickable text URLs), “text_mention” (for users without usernames) */
    public string $type;

    /** @var int Offset in UTF-16 code units to the start of the entity */
    public int $offset;

    /** @var int Length of the entity in UTF-16 code units */
    public int $length;

    /** @var string|null For “text_link” only, url that will be opened after user taps on the text */
    public ?string $url = null;

    /** @var User|null For “text_mention” only, the mentioned user */
    public ?User $user = null;

    /** @var string|null For “pre” only, the programming language of the entity text */
    public ?string $language = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->type = $array['type'];
        $this->offset = $array['offset'];
        $this->length = $array['length'];
        $this->url = $array['url'] ?? null;
        $this->user = isset($array['user']) ? new User($array['user'], $Bot) : null;
        $this->language = $array['language'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
