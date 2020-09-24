<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents an issue with the translated version of a document. The error is considered resolved when a file with the document translation change.
*/
class PassportElementErrorTranslationFiles extends \Telegram\PassportElementErrorTranslationFiles{

   /** @var string Error source, must be unspecified */
   public string $source;

   /** @var string Type of element of the user's Telegram Passport which has the issue */
   public string $type;

   /** @var string Base64-encoded element hash */
   public string $element_hash;

   /** @var string Error message */
   public string $message;


}

?>
