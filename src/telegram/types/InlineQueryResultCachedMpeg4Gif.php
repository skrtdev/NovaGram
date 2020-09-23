<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineQueryResultCachedMpeg4Gif extends \Telegram\InlineQueryResultCachedMpeg4Gif{

   public string $type;
   public string $id;
   public string $sticker_file_id;
   public ?InlineKeyboardMarkup $reply_markup;
   public ?InputMessageContent $input_message_content;

}

?>