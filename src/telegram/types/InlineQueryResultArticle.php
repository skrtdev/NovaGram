<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineQueryResultArticle extends \Telegram\InlineQueryResultArticle{

   public string $type;
   public string $id;
   public string $photo_url;
   public string $thumb_url;
   public ?int $photo_width;
   public ?int $photo_height;
   public ?string $title;
   public ?string $description;
   public ?string $caption;
   public ?string $parse_mode;
   public ?InlineKeyboardMarkup $reply_markup;
   public ?InputMessageContent $input_message_content;

}

?>