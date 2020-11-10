<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * Contains data required for decrypting and authenticating EncryptedPassportElement. See the Telegram Passport Documentation for a complete description of the data decryption and authentication processes.
*/
class EncryptedCredentials extends \Telegram\EncryptedCredentials{

    use simpleProto;

    /** @var string Base64-encoded encrypted JSON-serialized data with unique user's payload, data hashes and secrets required for EncryptedPassportElement decryption and authentication */
    public string $data;

    /** @var string Base64-encoded data hash for data authentication */
    public string $hash;

    /** @var string Base64-encoded secret, encrypted with the bot's public RSA key, required for data decryption */
    public string $secret;

    
}

?>
