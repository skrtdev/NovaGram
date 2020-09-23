<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineQueryResultCachedVideo extends \Telegram\InlineQueryResultCachedVideo{

   public string $type;
   public string $id;
   public string $voice_file_id;
   public string $title;
   public ?string $caption;
   public ?string $parse_mode;
   public ?InlineKeyboardMarkup $reply_markup;
   public ?InputMessageContent $input_message_content;

}

?>