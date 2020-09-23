<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineQueryResultVideo extends \Telegram\InlineQueryResultVideo{

   public string $type;
   public string $id;
   public string $audio_url;
   public string $title;
   public ?string $caption;
   public ?string $parse_mode;
   public ?string $performer;
   public ?int $audio_duration;
   public ?InlineKeyboardMarkup $reply_markup;
   public ?InputMessageContent $input_message_content;

}

?>