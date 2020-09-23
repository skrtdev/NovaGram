<?php

namespace skrtdev\Telegram;

use \stdClass;

class PollOption extends \Telegram\PollOption{

   public string $text;
   public int $voter_count;

}

?>