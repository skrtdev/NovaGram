<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineQueryResultCachedSticker extends \Telegram\InlineQueryResultCachedSticker{

   public string $type;
   public string $id;
   public string $title;
   public string $document_file_id;
   public ?string $description;
   public ?string $caption;
   public ?string $parse_mode;
   public ?InlineKeyboardMarkup $reply_markup;
   public ?InputMessageContent $input_message_content;

}

?>