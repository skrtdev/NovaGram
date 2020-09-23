<?php

namespace skrtdev\Telegram;

use \stdClass;

class InputMediaDocument extends \Telegram\InputMediaDocument{

   public string $type;
   public string $media;
   public $thumb;
   public ?string $caption;
   public ?string $parse_mode;

}

?>