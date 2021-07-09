<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents an issue with the front side of a document. The error is considered resolved when the file with the front side of the document changes.
*/
class PassportElementErrorFrontSide extends Type{
    
    /** @var string Error source, must be front_side */
    public string $source;

    /** @var string The section of the user's Telegram Passport which has the issue, one of “passport”, “driver_license”, “identity_card”, “internal_passport” */
    public string $type;

    /** @var string Base64-encoded hash of the file with the front side of the document */
    public string $file_hash;

    /** @var string Error message */
    public string $message;

    public function __construct(array $array, Bot $Bot = null){
        $this->source = $array['source'];
        $this->type = $array['type'];
        $this->file_hash = $array['file_hash'];
        $this->message = $array['message'];
        parent::__construct($array, $Bot);
    }
    
    
}
