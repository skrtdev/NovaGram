<?php

namespace skrtdev\Telegram;

use \stdClass;

class VideoNote extends \Telegram\VideoNote{

   public string $file_id;
   public string $file_unique_id;
   public int $length;
   public int $duration;
   public ?PhotoSize $thumb;
   public ?int $file_size;

}

?>