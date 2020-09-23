<?php

namespace skrtdev\Telegram;

use \stdClass;

class InputMediaPhoto extends \Telegram\InputMediaPhoto{

   public string $type;
   public string $media;
   public ?string $caption;
   public ?string $parse_mode;

}

?>