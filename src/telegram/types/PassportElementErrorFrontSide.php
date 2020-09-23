<?php

namespace skrtdev\Telegram;

use \stdClass;

class PassportElementErrorFrontSide extends \Telegram\PassportElementErrorFrontSide{

   public string $source;
   public string $type;
   public string $file_hash;
   public string $message;

}

?>