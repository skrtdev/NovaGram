<?php

namespace skrtdev\Telegram;

use \stdClass;

class CallbackQuery extends \Telegram\CallbackQuery{

   public string $id;
   public User $from;
   public ?Message $message;
   public ?string $inline_message_id;
   public string $chat_instance;
   public ?string $data;
   public ?string $game_short_name;

}

?>