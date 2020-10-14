<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object contains information about an incoming pre-checkout query.
*/
class PreCheckoutQuery extends \Telegram\PreCheckoutQuery{

    use simpleProto;

    /** @var stdClass Array with information about documents and other Telegram Passport elements that was shared with the bot */
    public stdClass $data;

    /** @var EncryptedCredentials Encrypted credentials required to decrypt the data */
    public EncryptedCredentials $credentials;

    
}

?>
