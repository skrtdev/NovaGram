<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineQueryResultVoice extends \Telegram\InlineQueryResultVoice{

   public string $type;
   public string $id;
   public string $title;
   public ?string $caption;
   public ?string $parse_mode;
   public string $document_url;
   public string $mime_type;
   public ?string $description;
   public ?InlineKeyboardMarkup $reply_markup;
   public ?InputMessageContent $input_message_content;
   public ?string $thumb_url;
   public ?int $thumb_width;
   public ?int $thumb_height;

}

?>