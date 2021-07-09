<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents one shipping option.
*/
class ShippingOption extends Type{
    
    /** @var string Shipping option identifier */
    public string $id;

    /** @var string Option title */
    public string $title;

    /** @var ObjectsList List of price portions */
    public ObjectsList $prices;

    public function __construct(array $array, Bot $Bot = null){
        $this->id = $array['id'];
        $this->title = $array['title'];
        $this->prices = new ObjectsList(iterate($array['prices'], fn($item) => new LabeledPrice($item, $Bot)));
        parent::__construct($array, $Bot);
    }
    
    
}
