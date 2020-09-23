<?php

namespace skrtdev\Telegram;

use \stdClass;

class OrderInfo extends \Telegram\OrderInfo{

   public string $id;
   public string $title;
   public stdClass $prices;

}

?>