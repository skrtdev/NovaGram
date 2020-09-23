<?php

namespace skrtdev\Telegram;

use \stdClass;

class MaskPosition extends \Telegram\MaskPosition{

   public $chat_id;
   public $sticker;
   public bool $disable_notification;
   public int $reply_to_message_id;
   public $reply_markup;

}

?>