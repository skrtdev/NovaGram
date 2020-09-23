<?php

namespace skrtdev\Telegram;

use \stdClass;

class PassportElementErrorTranslationFile extends \Telegram\PassportElementErrorTranslationFile{

   public string $source;
   public string $type;
   public stdClass $file_hashes;
   public string $message;

}

?>