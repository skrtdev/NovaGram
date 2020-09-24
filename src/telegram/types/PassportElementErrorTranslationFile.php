<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents an issue with one of the files that constitute the translation of a document. The error is considered resolved when the file changes.
*/
class PassportElementErrorTranslationFile extends \Telegram\PassportElementErrorTranslationFile{

   /** @var string Error source, must be translation_files */
   public string $source;

   /** @var string Type of element of the user's Telegram Passport which has the issue, one of “passport”, “driver_license”, “identity_card”, “internal_passport”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration” */
   public string $type;

   /** @var stdClass List of base64-encoded file hashes */
   public stdClass $file_hashes;

   /** @var string Error message */
   public string $message;


}

?>
