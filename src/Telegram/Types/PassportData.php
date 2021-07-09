<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Contains information about Telegram Passport data shared with the bot by the user.
*/
class PassportData extends Type{
    
    /** @var ObjectsList Array with information about documents and other Telegram Passport elements that was shared with the bot */
    public ObjectsList $data;

    /** @var EncryptedCredentials Encrypted credentials required to decrypt the data */
    public EncryptedCredentials $credentials;

    public function __construct(array $array, Bot $Bot = null){
        $this->data = new ObjectsList(iterate($array['data'], fn($item) => new EncryptedPassportElement($item, $Bot)));
        $this->credentials = new EncryptedCredentials($array['credentials'], $Bot);
        parent::__construct($array, $Bot);
    }
    
    
}
