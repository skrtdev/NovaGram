<?php

namespace skrtdev\Telegram;

use \stdClass;

class InputMediaAnimation extends \Telegram\InputMediaAnimation{

   public string $type;
   public string $media;
   public $thumb;
   public ?string $caption;
   public ?string $parse_mode;
   public ?int $width;
   public ?int $height;
   public ?int $duration;

}

?>