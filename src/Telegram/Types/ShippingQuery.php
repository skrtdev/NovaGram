<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object contains information about an incoming shipping query.
*/
class ShippingQuery extends Type{
    
    /** @var string Unique query identifier */
    public string $id;

    /** @var User User who sent the query */
    public User $from;

    /** @var string Bot specified invoice payload */
    public string $invoice_payload;

    /** @var ShippingAddress User specified shipping address */
    public ShippingAddress $shipping_address;

    public function __construct(array $array, Bot $Bot = null){
        $this->id = $array['id'];
        $this->from = new User($array['from'], $Bot);
        $this->invoice_payload = $array['invoice_payload'];
        $this->shipping_address = new ShippingAddress($array['shipping_address'], $Bot);
        parent::__construct($array, $Bot);
    }
    
    
}
