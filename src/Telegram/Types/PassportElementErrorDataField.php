<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Represents an issue in one of the data fields that was provided by the user. The error is considered resolved when the field's value changes.
*/
class PassportElementErrorDataField extends Type{
    
    /** @var string Error source, must be data */
    public string $source;

    /** @var string The section of the user's Telegram Passport which has the error, one of “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport”, “address” */
    public string $type;

    /** @var string Name of the data field which has the error */
    public string $field_name;

    /** @var string Base64-encoded data hash */
    public string $data_hash;

    /** @var string Error message */
    public string $message;

    public function __construct(array $array, Bot $Bot = null){
        $this->source = $array['source'];
        $this->type = $array['type'];
        $this->field_name = $array['field_name'];
        $this->data_hash = $array['data_hash'];
        $this->message = $array['message'];
        parent::__construct($array, $Bot);
    }
    
    
}
