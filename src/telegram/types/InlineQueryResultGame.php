<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineQueryResultGame extends \Telegram\InlineQueryResultGame{

   public string $type;
   public string $id;
   public string $photo_file_id;
   public ?string $title;
   public ?string $description;
   public ?string $caption;
   public ?string $parse_mode;
   public ?InlineKeyboardMarkup $reply_markup;
   public ?InputMessageContent $input_message_content;

}

?>