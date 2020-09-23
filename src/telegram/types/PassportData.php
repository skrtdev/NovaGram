<?php

namespace skrtdev\Telegram;

use \stdClass;

class PassportData extends \Telegram\PassportData{

   public string $file_id;
   public string $file_unique_id;
   public int $file_size;
   public int $file_date;

}

?>