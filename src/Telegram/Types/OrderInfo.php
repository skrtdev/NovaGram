<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents information about an order.
*/
class OrderInfo extends Type{
    
    /** @var string|null User name */
    public ?string $name = null;

    /** @var string|null User's phone number */
    public ?string $phone_number = null;

    /** @var string|null User email */
    public ?string $email = null;

    /** @var ShippingAddress|null User shipping address */
    public ?ShippingAddress $shipping_address = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->name = $array['name'] ?? null;
        $this->phone_number = $array['phone_number'] ?? null;
        $this->email = $array['email'] ?? null;
        $this->shipping_address = isset($array['shipping_address']) ? new ShippingAddress($array['shipping_address'], $Bot) : null;
        parent::__construct($array, $Bot);
    }
    
    
}
