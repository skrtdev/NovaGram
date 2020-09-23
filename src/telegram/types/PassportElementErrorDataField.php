<?php

namespace skrtdev\Telegram;

use \stdClass;

class PassportElementErrorDataField extends \Telegram\PassportElementErrorDataField{

   public string $source;
   public string $type;
   public string $file_hash;
   public string $message;

}

?>