<?php

namespace skrtdev\Telegram;

use \stdClass;

class InputContactMessageContent extends \Telegram\InputContactMessageContent{

   public string $result_id;
   public User $from;
   public ?Location $location;
   public ?string $inline_message_id;
   public string $query;

}

?>