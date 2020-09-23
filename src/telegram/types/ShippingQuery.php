<?php

namespace skrtdev\Telegram;

use \stdClass;

class ShippingQuery extends \Telegram\ShippingQuery{

   public string $id;
   public User $from;
   public string $currency;
   public int $total_amount;
   public string $invoice_payload;
   public ?string $shipping_option_id;
   public ?OrderInfo $order_info;

}

?>