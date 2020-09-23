<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineQueryResultContact extends \Telegram\InlineQueryResultContact{

   public string $type;
   public string $id;
   public string $game_short_name;
   public ?InlineKeyboardMarkup $reply_markup;

}

?>