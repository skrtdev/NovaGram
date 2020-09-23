<?php

namespace skrtdev\Telegram;

use \stdClass;

class EncryptedCredentials extends \Telegram\EncryptedCredentials{

   public int $user_id;
   public stdClass $errors;

}

?>