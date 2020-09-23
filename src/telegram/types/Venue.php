<?php

namespace skrtdev\Telegram;

use \stdClass;

class Venue extends \Telegram\Venue{

   public Location $location;
   public string $title;
   public string $address;
   public ?string $foursquare_id;
   public ?string $foursquare_type;

}

?>