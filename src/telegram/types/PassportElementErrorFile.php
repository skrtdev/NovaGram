<?php

namespace skrtdev\Telegram;

use \stdClass;

class PassportElementErrorFile extends \Telegram\PassportElementErrorFile{

   public string $source;
   public string $type;
   public stdClass $file_hashes;
   public string $message;

}

?>