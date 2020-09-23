<?php

namespace skrtdev\Telegram;

use \stdClass;

class PassportElementErrorFiles extends \Telegram\PassportElementErrorFiles{

   public string $source;
   public string $type;
   public string $file_hash;
   public string $message;

}

?>