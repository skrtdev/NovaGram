<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Represents an issue with a document scan. The error is considered resolved when the file with the document scan changes.
*/
class PassportElementErrorFile extends \Telegram\PassportElementErrorFile{

    use simpleProto;

    /** @var string Error source, must be file */
    public string $source;

    /** @var string The section of the user's Telegram Passport which has the issue, one of “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration” */
    public string $type;

    /** @var string Base64-encoded file hash */
    public string $file_hash;

    /** @var string Error message */
    public string $message;

    
}

?>
