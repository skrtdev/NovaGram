<?php

namespace skrtdev\Telegram;

use \stdClass;

class ReplyKeyboardRemove extends \Telegram\ReplyKeyboardRemove{

   public bool $remove_keyboard;
   public ?bool $selective;

}

?>