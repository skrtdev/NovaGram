<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents a portion of the price for goods or services.
*/
class LabeledPrice extends \Telegram\LabeledPrice{

    use simpleProto;

    /** @var string Product name */
    public string $title;

    /** @var string Product description */
    public string $description;

    /** @var string Unique bot deep-linking parameter that can be used to generate this invoice */
    public string $start_parameter;

    /** @var string Three-letter ISO 4217 currency code */
    public string $currency;

    /** @var int Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies). */
    public int $total_amount;

    
}

?>
