<?php

namespace skrtdev\Telegram;

use \stdClass;

class PreCheckoutQuery extends \Telegram\PreCheckoutQuery{

   public stdClass $data;
   public EncryptedCredentials $credentials;

}

?>