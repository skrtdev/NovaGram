<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents an issue in one of the data fields that was provided by the user. The error is considered resolved when the field's value changes.
*/
class PassportElementErrorDataField extends \Telegram\PassportElementErrorDataField{

   /** @var string Error source, must be front_side */
   public string $source;

   /** @var string The section of the user's Telegram Passport which has the issue, one of “passport”, “driver_license”, “identity_card”, “internal_passport” */
   public string $type;

   /** @var string Base64-encoded hash of the file with the front side of the document */
   public string $file_hash;

   /** @var string Error message */
   public string $message;


}

?>
