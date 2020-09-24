<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents an issue in an unspecified place. The error is considered resolved when new data is added.
*/
class PassportElementErrorUnspecified extends \Telegram\PassportElementErrorUnspecified{

   /** @var int Yes */
   public int $chat_id;

   /** @var string Yes */
   public string $game_short_name;

   /** @var bool Optional */
   public bool $disable_notification;

   /** @var int Optional */
   public int $reply_to_message_id;

   /** @var InlineKeyboardMarkup Optional */
   public InlineKeyboardMarkup $reply_markup;


}

?>
