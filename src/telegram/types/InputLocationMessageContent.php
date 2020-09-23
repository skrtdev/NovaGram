<?php

namespace skrtdev\Telegram;

use \stdClass;

class InputLocationMessageContent extends \Telegram\InputLocationMessageContent{

   public float $latitude;
   public float $longitude;
   public string $title;
   public string $address;
   public ?string $foursquare_id;
   public ?string $foursquare_type;

}

?>