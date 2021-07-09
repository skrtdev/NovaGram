<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents an issue with the reverse side of a document. The error is considered resolved when the file with reverse side of the document changes.
*/
class PassportElementErrorReverseSide extends Type{
    
    /** @var string Error source, must be reverse_side */
    public string $source;

    /** @var string The section of the user's Telegram Passport which has the issue, one of “driver_license”, “identity_card” */
    public string $type;

    /** @var string Base64-encoded hash of the file with the reverse side of the document */
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
