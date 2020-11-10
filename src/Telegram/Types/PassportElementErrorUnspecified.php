<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Represents an issue in an unspecified place. The error is considered resolved when new data is added.
*/
class PassportElementErrorUnspecified extends \Telegram\PassportElementErrorUnspecified{

    use simpleProto;

    /** @var string Error source, must be unspecified */
    public string $source;

    /** @var string Type of element of the user's Telegram Passport which has the issue */
    public string $type;

    /** @var string Base64-encoded element hash */
    public string $element_hash;

    /** @var string Error message */
    public string $message;

    
}

?>
