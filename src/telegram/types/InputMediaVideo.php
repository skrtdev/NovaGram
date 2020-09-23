<?php

namespace skrtdev\Telegram;

use \stdClass;

class InputMediaVideo extends \Telegram\InputMediaVideo{

   public string $type;
   public string $media;
   public $thumb;
   public ?string $caption;
   public ?string $parse_mode;
   public ?int $width;
   public ?int $height;
   public ?int $duration;
   public ?bool $supports_streaming;

}

?>