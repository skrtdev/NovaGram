<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents type of a poll, which is allowed to be created and sent when the corresponding button is pressed.
*/
class KeyboardButtonPollType extends \Telegram\KeyboardButtonPollType{

    use simpleProto;

    /** @var string|null If quiz is passed, the user will be allowed to create only polls in the quiz mode. If regular is passed, only regular polls will be allowed. Otherwise, the user will be allowed to create a poll of any type. */
    public ?string $type = null;

    
}

?>
