<?php

namespace skrtdev\Telegram;

use \stdClass;

class InputMediaAudio extends \Telegram\InputMediaAudio{

   public string $type;
   public string $media;
   public $thumb;
   public ?string $caption;
   public ?string $parse_mode;
   public ?int $duration;
   public ?string $performer;
   public ?string $title;

}

?>