<?php

namespace skrtdev\Telegram;

use \stdClass;

class Animation extends \Telegram\Animation{

   public string $file_id;
   public string $file_unique_id;
   public int $width;
   public int $height;
   public int $duration;
   public ?PhotoSize $thumb;
   public ?string $file_name;
   public ?string $mime_type;
   public ?int $file_size;

}

?>