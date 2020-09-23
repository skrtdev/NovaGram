<?php

namespace skrtdev\Telegram;

use \stdClass;

class ShippingOption extends \Telegram\ShippingOption{

   public string $currency;
   public int $total_amount;
   public string $invoice_payload;
   public ?string $shipping_option_id;
   public ?OrderInfo $order_info;
   public string $telegram_payment_charge_id;
   public string $provider_payment_charge_id;

}

?>