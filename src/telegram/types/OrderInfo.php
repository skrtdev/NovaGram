<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents information about an order.
*/
class OrderInfo extends \Telegram\OrderInfo{

    /** @var string Shipping option identifier */
    public string $id;

    /** @var string Option title */
    public string $title;

    /** @var stdClass List of price portions */
    public stdClass $prices;

    
}

?>
