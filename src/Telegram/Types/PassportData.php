<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Contains information about Telegram Passport data shared with the bot by the user.
*/
class PassportData extends \Telegram\PassportData{

    use simpleProto;

    /** @var stdClass Array with information about documents and other Telegram Passport elements that was shared with the bot */
    public stdClass $data;

    /** @var EncryptedCredentials Encrypted credentials required to decrypt the data */
    public EncryptedCredentials $credentials;

    
}

?>
