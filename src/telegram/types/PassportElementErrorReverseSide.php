<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents an issue with the reverse side of a document. The error is considered resolved when the file with reverse side of the document changes.
*/
class PassportElementErrorReverseSide extends \Telegram\PassportElementErrorReverseSide{

    /** @var string Error source, must be selfie */
    public string $source;

    /** @var string The section of the user's Telegram Passport which has the issue, one of “passport”, “driver_license”, “identity_card”, “internal_passport” */
    public string $type;

    /** @var string Base64-encoded hash of the file with the selfie */
    public string $file_hash;

    /** @var string Error message */
    public string $message;

    
}

?>
