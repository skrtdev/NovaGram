<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents a phone contact.
*/
class Contact extends \Telegram\Contact{

   /** @var string Contact's phone number */
   public string $phone_number;

   /** @var string Contact's first name */
   public string $first_name;

   /** @var string|null Contact's last name */
   public ?string $last_name = null;

   /** @var int|null Contact's user identifier in Telegram */
   public ?int $user_id = null;

   /** @var string|null Additional data about the contact in the form of a vCard */
   public ?string $vcard = null;


}

?>
