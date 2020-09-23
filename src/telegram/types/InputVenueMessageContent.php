<?php

namespace skrtdev\Telegram;

use \stdClass;

class InputVenueMessageContent extends \Telegram\InputVenueMessageContent{

   public string $phone_number;
   public string $first_name;
   public ?string $last_name;
   public ?string $vcard;

}

?>