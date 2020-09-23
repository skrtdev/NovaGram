<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineQueryResultCachedVoice extends \Telegram\InlineQueryResultCachedVoice{

   public string $type;
   public string $id;
   public string $audio_file_id;
   public ?string $caption;
   public ?string $parse_mode;
   public ?InlineKeyboardMarkup $reply_markup;
   public ?InputMessageContent $input_message_content;

}

?>