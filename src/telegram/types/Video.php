<?php

namespace skrtdev\Telegram;

use \stdClass;

class Video extends \Telegram\Video{

   public string $file_id;
   public string $file_unique_id;
   public int $width;
   public int $height;
   public int $duration;
   public ?PhotoSize $thumb;
   public ?string $mime_type;
   public ?int $file_size;

}

?>