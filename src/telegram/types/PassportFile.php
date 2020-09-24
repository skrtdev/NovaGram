<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents a file uploaded to Telegram Passport. Currently all Telegram Passport files are in JPEG format when decrypted and don't exceed 10MB.
*/
class PassportFile extends \Telegram\PassportFile{

   /** @var string Element type. One of “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport”, “address”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”, “phone_number”, “email”. */
   public string $type;

   /** @var string|null Base64-encoded encrypted Telegram Passport element data provided by the user, available for “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport” and “address” types. Can be decrypted and verified using the accompanying EncryptedCredentials. */
   public ?string $data = null;

   /** @var string|null User's verified phone number, available only for “phone_number” type */
   public ?string $phone_number = null;

   /** @var string|null User's verified email address, available only for “email” type */
   public ?string $email = null;

   /** @var stdClass|null Array of encrypted files with documents provided by the user, available for “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be decrypted and verified using the accompanying EncryptedCredentials. */
   public ?stdClass $files = null;

   /** @var PassportFile|null Encrypted file with the front side of the document, provided by the user. Available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified using the accompanying EncryptedCredentials. */
   public ?PassportFile $front_side = null;

   /** @var PassportFile|null Encrypted file with the reverse side of the document, provided by the user. Available for “driver_license” and “identity_card”. The file can be decrypted and verified using the accompanying EncryptedCredentials. */
   public ?PassportFile $reverse_side = null;

   /** @var PassportFile|null Encrypted file with the selfie of the user holding a document, provided by the user; available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified using the accompanying EncryptedCredentials. */
   public ?PassportFile $selfie = null;

   /** @var stdClass|null Array of encrypted files with translated versions of documents provided by the user. Available if requested for “passport”, “driver_license”, “identity_card”, “internal_passport”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be decrypted and verified using the accompanying EncryptedCredentials. */
   public ?stdClass $translation = null;

   /** @var string Base64-encoded element hash for using in PassportElementErrorUnspecified */
   public string $hash;


}

?>
