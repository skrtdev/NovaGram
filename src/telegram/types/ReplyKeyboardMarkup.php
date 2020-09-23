<?php

namespace skrtdev\Telegram;

use \stdClass;

class ReplyKeyboardMarkup extends \Telegram\ReplyKeyboardMarkup{

   public stdClass $keyboard;
   public ?bool $resize_keyboard;
   public ?bool $one_time_keyboard;
   public ?bool $selective;

}

?>