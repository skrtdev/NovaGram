<?php

namespace skrtdev\Telegram;

use \stdClass;

class ChatPhoto extends \Telegram\ChatPhoto{

   public string $small_file_id;
   public string $small_file_unique_id;
   public string $big_file_id;
   public string $big_file_unique_id;

}

?>