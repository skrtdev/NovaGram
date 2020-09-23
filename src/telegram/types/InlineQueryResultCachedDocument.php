<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineQueryResultCachedDocument extends \Telegram\InlineQueryResultCachedDocument{

   public string $type;
   public string $id;
   public string $video_file_id;
   public string $title;
   public ?string $description;
   public ?string $caption;
   public ?string $parse_mode;
   public ?InlineKeyboardMarkup $reply_markup;
   public ?InputMessageContent $input_message_content;

}

?>