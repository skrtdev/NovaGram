<?php

namespace skrtdev\Telegram;

use \stdClass;

class PassportFile extends \Telegram\PassportFile{

   public string $type;
   public ?string $data;
   public ?string $phone_number;
   public ?string $email;
   public ?stdClass $files;
   public ?PassportFile $front_side;
   public ?PassportFile $reverse_side;
   public ?PassportFile $selfie;
   public ?stdClass $translation;
   public string $hash;

}

?>