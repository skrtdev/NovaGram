<?php

namespace skrtdev\Telegram;

use \stdClass;

class SuccessfulPayment extends \Telegram\SuccessfulPayment{

   public string $id;
   public User $from;
   public string $invoice_payload;
   public ShippingAddress $shipping_address;

}

?>