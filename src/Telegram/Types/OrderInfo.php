<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents information about an order.
*/
class OrderInfo extends \Telegram\OrderInfo{

    use simpleProto;

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
