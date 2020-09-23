<?php

namespace skrtdev\Telegram;

use \stdClass;

class Invoice extends \Telegram\Invoice{

   public string $country_code;
   public string $state;
   public string $city;
   public string $street_line1;
   public string $street_line2;
   public string $post_code;

}

?>