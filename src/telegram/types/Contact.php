<?php

namespace skrtdev\Telegram;

use \stdClass;

class Contact extends \Telegram\Contact{

   public string $phone_number;
   public string $first_name;
   public ?string $last_name;
   public ?int $user_id;
   public ?string $vcard;

}

?>