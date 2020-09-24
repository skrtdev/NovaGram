<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Contains data required for decrypting and authenticating EncryptedPassportElement. See the Telegram Passport Documentation for a complete description of the data decryption and authentication processes.
*/
class EncryptedCredentials extends \Telegram\EncryptedCredentials{

   /** @var int Yes */
   public int $user_id;

   /** @var stdClass Yes */
   public stdClass $errors;


}

?>
