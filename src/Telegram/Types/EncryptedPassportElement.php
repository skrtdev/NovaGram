<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * Contains information about documents or other Telegram Passport elements shared with the bot by the user.
*/
class EncryptedPassportElement extends Type{
    
    /** @var string Element type. One of “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport”, “address”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”, “phone_number”, “email”. */
    public string $type;

    /** @var string|null Base64-encoded encrypted Telegram Passport element data provided by the user, available for “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport” and “address” types. Can be decrypted and verified using the accompanying EncryptedCredentials. */
    public ?string $data = null;

    /** @var string|null User's verified phone number, available only for “phone_number” type */
    public ?string $phone_number = null;

    /** @var string|null User's verified email address, available only for “email” type */
    public ?string $email = null;

    /** @var ObjectsList|null Array of encrypted files with documents provided by the user, available for “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be decrypted and verified using the accompanying EncryptedCredentials. */
    public ?ObjectsList $files = null;

    /** @var PassportFile|null Encrypted file with the front side of the document, provided by the user. Available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified using the accompanying EncryptedCredentials. */
    public ?PassportFile $front_side = null;

    /** @var PassportFile|null Encrypted file with the reverse side of the document, provided by the user. Available for “driver_license” and “identity_card”. The file can be decrypted and verified using the accompanying EncryptedCredentials. */
    public ?PassportFile $reverse_side = null;

    /** @var PassportFile|null Encrypted file with the selfie of the user holding a document, provided by the user; available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified using the accompanying EncryptedCredentials. */
    public ?PassportFile $selfie = null;

    /** @var ObjectsList|null Array of encrypted files with translated versions of documents provided by the user. Available if requested for “passport”, “driver_license”, “identity_card”, “internal_passport”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be decrypted and verified using the accompanying EncryptedCredentials. */
    public ?ObjectsList $translation = null;

    /** @var string Base64-encoded element hash for using in PassportElementErrorUnspecified */
    public string $hash;

    public function __construct(array $array, Bot $Bot = null){
        $this->type = $array['type'];
        $this->data = $array['data'] ?? null;
        $this->phone_number = $array['phone_number'] ?? null;
        $this->email = $array['email'] ?? null;
        $this->files = isset($array['files']) ? new ObjectsList(iterate($array['files'], fn($item) => new PassportFile($item, $Bot))) : null;
        $this->front_side = isset($array['front_side']) ? new PassportFile($array['front_side'], $Bot) : null;
        $this->reverse_side = isset($array['reverse_side']) ? new PassportFile($array['reverse_side'], $Bot) : null;
        $this->selfie = isset($array['selfie']) ? new PassportFile($array['selfie'], $Bot) : null;
        $this->translation = isset($array['translation']) ? new ObjectsList(iterate($array['translation'], fn($item) => new PassportFile($item, $Bot))) : null;
        $this->hash = $array['hash'];
        parent::__construct($array, $Bot);
    }
    
    
}
