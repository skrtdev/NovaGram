<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Represents an issue with a list of scans. The error is considered resolved when the list of files containing the scans changes.
*/
class PassportElementErrorFiles extends \Telegram\PassportElementErrorFiles{

    use simpleProto;

    /** @var string Error source, must be files */
    public string $source;

    /** @var string The section of the user's Telegram Passport which has the issue, one of “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration” */
    public string $type;

    /** @var stdClass List of base64-encoded file hashes */
    public stdClass $file_hashes;

    /** @var string Error message */
    public string $message;

    
}

?>
