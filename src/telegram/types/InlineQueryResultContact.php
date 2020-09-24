<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents a contact with a phone number. By default, this contact will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the contact.
*/
class InlineQueryResultContact extends \Telegram\InlineQueryResultContact{

   /** @var string Type of the result, must be game */
   public string $type;

   /** @var string Unique identifier for this result, 1-64 bytes */
   public string $id;

   /** @var string Short name of the game */
   public string $game_short_name;

   /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
   public ?InlineKeyboardMarkup $reply_markup = null;


}

?>
