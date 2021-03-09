<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents a phone contact.
*/
class Contact extends \Telegram\Contact{

    use simpleProto;

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

    
}

?>
