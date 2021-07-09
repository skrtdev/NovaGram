<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents an issue in an unspecified place. The error is considered resolved when new data is added.
*/
class PassportElementErrorUnspecified extends Type{
    
    /** @var string Error source, must be unspecified */
    public string $source;

    /** @var string Type of element of the user's Telegram Passport which has the issue */
    public string $type;

    /** @var string Base64-encoded element hash */
    public string $element_hash;

    /** @var string Error message */
    public string $message;

    public function __construct(array $array, Bot $Bot = null){
        $this->source = $array['source'];
        $this->type = $array['type'];
        $this->element_hash = $array['element_hash'];
        $this->message = $array['message'];
        parent::__construct($array, $Bot);
    }
    
    
}
