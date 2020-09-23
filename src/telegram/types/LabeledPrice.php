<?php

namespace skrtdev\Telegram;

use \stdClass;

class LabeledPrice extends \Telegram\LabeledPrice{

   public string $title;
   public string $description;
   public string $start_parameter;
   public string $currency;
   public int $total_amount;

}

?>