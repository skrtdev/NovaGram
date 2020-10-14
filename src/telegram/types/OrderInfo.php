<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents information about an order.
*/
class OrderInfo extends \Telegram\OrderInfo{

    use simpleProto;

    /** @var string Shipping option identifier */
    public string $id;

    /** @var string Option title */
    public string $title;

    /** @var stdClass List of price portions */
    public stdClass $prices;

    
}

?>
