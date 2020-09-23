<?php

namespace skrtdev\Telegram;

use \stdClass;

class Voice extends \Telegram\Voice{

   public string $file_id;
   public string $file_unique_id;
   public int $duration;
   public ?string $mime_type;
   public ?int $file_size;

}

?>