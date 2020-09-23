<?php

namespace skrtdev\Telegram;

use \stdClass;

class ShippingAddress extends \Telegram\ShippingAddress{

   public ?string $name;
   public ?string $phone_number;
   public ?string $email;
   public ?ShippingAddress $shipping_address;

}

?>