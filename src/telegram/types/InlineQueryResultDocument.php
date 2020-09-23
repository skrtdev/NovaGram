<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineQueryResultDocument extends \Telegram\InlineQueryResultDocument{

   public string $type;
   public string $id;
   public float $latitude;
   public float $longitude;
   public string $title;
   public ?int $live_period;
   public ?InlineKeyboardMarkup $reply_markup;
   public ?InputMessageContent $input_message_content;
   public ?string $thumb_url;
   public ?int $thumb_width;
   public ?int $thumb_height;

}

?>