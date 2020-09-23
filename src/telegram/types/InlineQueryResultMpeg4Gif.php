<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineQueryResultMpeg4Gif extends \Telegram\InlineQueryResultMpeg4Gif{

   public string $type;
   public string $id;
   public string $video_url;
   public string $mime_type;
   public string $thumb_url;
   public string $title;
   public ?string $caption;
   public ?string $parse_mode;
   public ?int $video_width;
   public ?int $video_height;
   public ?int $video_duration;
   public ?string $description;
   public ?InlineKeyboardMarkup $reply_markup;
   public ?InputMessageContent $input_message_content;

}

?>