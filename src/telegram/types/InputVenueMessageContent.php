<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Represents the content of a venue message to be sent as the result of an inline query.
*/
class InputVenueMessageContent extends \Telegram\InputVenueMessageContent{

    use simpleProto;

    /** @var string Contact's phone number */
    public string $phone_number;

    /** @var string Contact's first name */
    public string $first_name;

    /** @var string|null Contact's last name */
    public ?string $last_name = null;

    /** @var string|null Additional data about the contact in the form of a vCard, 0-2048 bytes */
    public ?string $vcard = null;

    
}

?>
