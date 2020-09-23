<?php

namespace skrtdev\Telegram;

use \stdClass;

class ForceReply extends \Telegram\ForceReply{

   public bool $force_reply;
   public ?bool $selective;

}

?>