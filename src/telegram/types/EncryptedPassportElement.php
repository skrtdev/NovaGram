<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Contains information about documents or other Telegram Passport elements shared with the bot by the user.
*/
class EncryptedPassportElement extends \Telegram\EncryptedPassportElement{

    /** @var string Base64-encoded encrypted JSON-serialized data with unique user's payload, data hashes and secrets required for EncryptedPassportElement decryption and authentication */
    public string $data;

    /** @var string Base64-encoded data hash for data authentication */
    public string $hash;

    /** @var string Base64-encoded secret, encrypted with the bot's public RSA key, required for data decryption */
    public string $secret;

    
}

?>
