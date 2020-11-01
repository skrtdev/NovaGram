<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object contains basic information about an invoice.
*/
class Invoice extends \Telegram\Invoice{

    use simpleProto;

    /** @var string ISO 3166-1 alpha-2 country code */
    public string $country_code;

    /** @var string State, if applicable */
    public string $state;

    /** @var string City */
    public string $city;

    /** @var string First line for the address */
    public string $street_line1;

    /** @var string Second line for the address */
    public string $street_line2;

    /** @var string Address post code */
    public string $post_code;

    
}

?>
