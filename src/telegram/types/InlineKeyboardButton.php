<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineKeyboardButton extends \Telegram\InlineKeyboardButton{

   public string $text;
   public ?string $url;
   public ?LoginUrl $login_url;
   public ?string $callback_data;
   public ?string $switch_inline_query;
   public ?string $switch_inline_query_current_chat;
   public ?CallbackGame $callback_game;
   public ?bool $pay;

}

?>