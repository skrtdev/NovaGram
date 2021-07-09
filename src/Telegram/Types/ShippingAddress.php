<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a shipping address.
*/
class ShippingAddress extends Type{
    
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

    public function __construct(array $array, Bot $Bot = null){
        $this->country_code = $array['country_code'];
        $this->state = $array['state'];
        $this->city = $array['city'];
        $this->street_line1 = $array['street_line1'];
        $this->street_line2 = $array['street_line2'];
        $this->post_code = $array['post_code'];
        parent::__construct($array, $Bot);
    }
    
    
}
