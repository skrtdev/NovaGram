<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents the content of a contact message to be sent as the result of an inline query.
*/
class InputContactMessageContent extends Type{
    
    /** @var string Contact's phone number */
    public string $phone_number;

    /** @var string Contact's first name */
    public string $first_name;

    /** @var string|null Contact's last name */
    public ?string $last_name = null;

    /** @var string|null Additional data about the contact in the form of a vCard, 0-2048 bytes */
    public ?string $vcard = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->phone_number = $array['phone_number'];
        $this->first_name = $array['first_name'];
        $this->last_name = $array['last_name'] ?? null;
        $this->vcard = $array['vcard'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
