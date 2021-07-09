<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents an issue with a document scan. The error is considered resolved when the file with the document scan changes.
*/
class PassportElementErrorFile extends Type{
    
    /** @var string Error source, must be file */
    public string $source;

    /** @var string The section of the user's Telegram Passport which has the issue, one of “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration” */
    public string $type;

    /** @var string Base64-encoded file hash */
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
