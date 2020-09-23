<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineQueryResultCachedPhoto extends \Telegram\InlineQueryResultCachedPhoto{

   public string $type;
   public string $id;
   public string $gif_file_id;
   public ?string $title;
   public ?string $caption;
   public ?string $parse_mode;
   public ?InlineKeyboardMarkup $reply_markup;
   public ?InputMessageContent $input_message_content;

}

?>