# EncryptedPassportElement	

Contains information about documents or other Telegram Passport elements shared with the bot by the user.	

## Properties	

- `$type`: _Element type. One of “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport”, “address”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”, “phone_number”, “email”._
- `$data`: _Optional. Base64-encoded encrypted Telegram Passport element data provided by the user, available for “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport” and “address” types. Can be decrypted and verified using the accompanying EncryptedCredentials._
- `$phone_number`: _Optional. User's verified phone number, available only for “phone_number” type_
- `$email`: _Optional. User's verified email address, available only for “email” type_
- `$files`: [`Array of PassportFile`](PassportFile.md) _Optional. Array of encrypted files with documents provided by the user, available for “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be decrypted and verified using the accompanying EncryptedCredentials._
- `$front_side`: [`PassportFile`](PassportFile.md) _Optional. Encrypted file with the front side of the document, provided by the user. Available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified using the accompanying EncryptedCredentials._
- `$reverse_side`: [`PassportFile`](PassportFile.md) _Optional. Encrypted file with the reverse side of the document, provided by the user. Available for “driver_license” and “identity_card”. The file can be decrypted and verified using the accompanying EncryptedCredentials._
- `$selfie`: [`PassportFile`](PassportFile.md) _Optional. Encrypted file with the selfie of the user holding a document, provided by the user; available for “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified using the accompanying EncryptedCredentials._
- `$translation`: [`Array of PassportFile`](PassportFile.md) _Optional. Array of encrypted files with translated versions of documents provided by the user. Available if requested for “passport”, “driver_license”, “identity_card”, “internal_passport”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be decrypted and verified using the accompanying EncryptedCredentials._
- `$hash`: _Base64-encoded element hash for using in PassportElementErrorUnspecified_

