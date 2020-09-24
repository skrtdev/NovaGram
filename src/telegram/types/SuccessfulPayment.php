<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object contains basic information about a successful payment.
*/
class SuccessfulPayment extends \Telegram\SuccessfulPayment{

   /** @var string Unique query identifier */
   public string $id;

   /** @var User User who sent the query */
   public User $from;

   /** @var string Bot specified invoice payload */
   public string $invoice_payload;

   /** @var ShippingAddress User specified shipping address */
   public ShippingAddress $shipping_address;


}

?>
