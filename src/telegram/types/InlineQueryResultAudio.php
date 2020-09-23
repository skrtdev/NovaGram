<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineQueryResultAudio extends \Telegram\InlineQueryResultAudio{

   public string $type;
   public string $id;
   public string $voice_url;
   public string $title;
   public ?string $caption;
   public ?string $parse_mode;
   public ?int $voice_duration;
   public ?InlineKeyboardMarkup $reply_markup;
   public ?InputMessageContent $input_message_content;

}

?>