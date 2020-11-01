<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents one shipping option.
*/
class ShippingOption extends \Telegram\ShippingOption{

    use simpleProto;

    /** @var string Three-letter ISO 4217 currency code */
    public string $currency;

    /** @var int Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies). */
    public int $total_amount;

    /** @var string Bot specified invoice payload */
    public string $invoice_payload;

    /** @var string|null Identifier of the shipping option chosen by the user */
    public ?string $shipping_option_id = null;

    /** @var OrderInfo|null Order info provided by the user */
    public ?OrderInfo $order_info = null;

    /** @var string Telegram payment identifier */
    public string $telegram_payment_charge_id;

    /** @var string Provider payment identifier */
    public string $provider_payment_charge_id;

    
}

?>
