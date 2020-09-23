<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineQueryResultCachedAudio extends \Telegram\InlineQueryResultCachedAudio{

   public string $message_text;
   public ?string $parse_mode;
   public ?bool $disable_web_page_preview;

}

?>