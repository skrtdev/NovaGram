<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object contains information about an incoming pre-checkout query.
*/
class PreCheckoutQuery extends Type{
    
    /** @var string Unique query identifier */
    public string $id;

    /** @var User User who sent the query */
    public User $from;

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

    public function __construct(array $array, Bot $Bot = null){
        $this->id = $array['id'];
        $this->from = new User($array['from'], $Bot);
        $this->currency = $array['currency'];
        $this->total_amount = $array['total_amount'];
        $this->invoice_payload = $array['invoice_payload'];
        $this->shipping_option_id = $array['shipping_option_id'] ?? null;
        $this->order_info = isset($array['order_info']) ? new OrderInfo($array['order_info'], $Bot) : null;
        parent::__construct($array, $Bot);
    }
    
    
}
