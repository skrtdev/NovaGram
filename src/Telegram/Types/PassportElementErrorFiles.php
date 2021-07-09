<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents an issue with a list of scans. The error is considered resolved when the list of files containing the scans changes.
*/
class PassportElementErrorFiles extends Type{
    
    /** @var string Error source, must be files */
    public string $source;

    /** @var string The section of the user's Telegram Passport which has the issue, one of “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration” */
    public string $type;

    /** @var ObjectsList List of base64-encoded file hashes */
    public ObjectsList $file_hashes;

    /** @var string Error message */
    public string $message;

    public function __construct(array $array, Bot $Bot = null){
        $this->source = $array['source'];
        $this->type = $array['type'];
        $this->file_hashes = new ObjectsList($array['file_hashes']);
        $this->message = $array['message'];
        parent::__construct($array, $Bot);
    }
    
    
}
