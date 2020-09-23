<?php

namespace skrtdev\Telegram;

use \stdClass;

class EncryptedPassportElement extends \Telegram\EncryptedPassportElement{

   public string $data;
   public string $hash;
   public string $secret;

}

?>