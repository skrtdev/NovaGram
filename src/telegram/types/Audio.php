<?php

namespace skrtdev\Telegram;

use \stdClass;

class Audio extends \Telegram\Audio{

   public string $file_id;
   public string $file_unique_id;
   public int $duration;
   public ?string $performer;
   public ?string $title;
   public ?string $mime_type;
   public ?int $file_size;
   public ?PhotoSize $thumb;

}

?>