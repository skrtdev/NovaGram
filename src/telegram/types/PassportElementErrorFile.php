<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents an issue with a document scan. The error is considered resolved when the file with the document scan changes.
*/
class PassportElementErrorFile extends \Telegram\PassportElementErrorFile{

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
