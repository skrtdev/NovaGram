<?php

namespace skrtdev\Telegram;

use \stdClass;

class PassportElementErrorUnspecified extends \Telegram\PassportElementErrorUnspecified{

   public int $chat_id;
   public string $game_short_name;
   public bool $disable_notification;
   public int $reply_to_message_id;
   public InlineKeyboardMarkup $reply_markup;

}

?>