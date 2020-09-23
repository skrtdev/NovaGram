<?php

namespace skrtdev\Telegram;

use \stdClass;

class MessageEntity extends \Telegram\MessageEntity{

   public string $type;
   public int $offset;
   public int $length;
   public ?string $url;
   public ?User $user;
   public ?string $language;

}

?>