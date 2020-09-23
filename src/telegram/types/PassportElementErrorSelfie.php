<?php

namespace skrtdev\Telegram;

use \stdClass;

class PassportElementErrorSelfie extends \Telegram\PassportElementErrorSelfie{

   public string $source;
   public string $type;
   public string $file_hash;
   public string $message;

}

?>