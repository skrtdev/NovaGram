<?php

namespace skrtdev\Telegram;

use \stdClass;

class InputTextMessageContent extends \Telegram\InputTextMessageContent{

   public float $latitude;
   public float $longitude;
   public ?int $live_period;

}

?>