<?php

namespace skrtdev\Telegram;

use \stdClass;

class File extends \Telegram\File{

   public string $file_id;
   public string $file_unique_id;
   public ?int $file_size;
   public ?string $file_path;

}

?>