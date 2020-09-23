<?php

namespace skrtdev\Telegram;

use \stdClass;

class Document extends \Telegram\Document{

   public string $file_id;
   public string $file_unique_id;
   public ?PhotoSize $thumb;
   public ?string $file_name;
   public ?string $mime_type;
   public ?int $file_size;

}

?>