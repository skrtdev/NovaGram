<?php

namespace skrtdev\Telegram;

use \stdClass;

class PollAnswer extends \Telegram\PollAnswer{

   public string $poll_id;
   public User $user;
   public stdClass $option_ids;

}

?>