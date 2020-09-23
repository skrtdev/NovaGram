<?php

namespace skrtdev\Telegram;

use \stdClass;

class PassportElementErrorReverseSide extends \Telegram\PassportElementErrorReverseSide{

   public string $source;
   public string $type;
   public string $file_hash;
   public string $message;

}

?>