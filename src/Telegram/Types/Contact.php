<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a phone contact.
*/
class Contact extends Type{
    
    /** @var string Contact's phone number */
    public string $phone_number;

    /** @var string Contact's first name */
    public string $first_name;

    /** @var string|null Contact's last name */
    public ?string $last_name = null;

    /** @var int|null Contact's user identifier in Telegram. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier. */
    public ?int $user_id = null;

    /** @var string|null Additional data about the contact in the form of a vCard */
    public ?string $vcard = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->phone_number = $array['phone_number'];
        $this->first_name = $array['first_name'];
        $this->last_name = $array['last_name'] ?? null;
        $this->user_id = $array['user_id'] ?? null;
        $this->vcard = $array['vcard'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
