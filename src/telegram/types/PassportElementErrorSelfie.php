<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents an issue with the selfie with a document. The error is considered resolved when the file with the selfie changes.
*/
class PassportElementErrorSelfie extends \Telegram\PassportElementErrorSelfie{

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
