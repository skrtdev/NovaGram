<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents a shipping address.
*/
class ShippingAddress extends \Telegram\ShippingAddress{

   /** @var string|null User name */
   public ?string $name = null;

   /** @var string|null User's phone number */
   public ?string $phone_number = null;

   /** @var string|null User email */
   public ?string $email = null;

   /** @var ShippingAddress|null User shipping address */
   public ?ShippingAddress $shipping_address = null;


}

?>
