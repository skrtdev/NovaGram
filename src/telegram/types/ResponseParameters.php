<?php

namespace skrtdev\Telegram;

use \stdClass;

class ResponseParameters extends \Telegram\ResponseParameters{

   public ?int $migrate_to_chat_id;
   public ?int $retry_after;

}

?>