<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents a venue. By default, the venue will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the venue.
*/
class InlineQueryResultVenue extends \Telegram\InlineQueryResultVenue{

   /** @var string Type of the result, must be contact */
   public string $type;

   /** @var string Unique identifier for this result, 1-64 Bytes */
   public string $id;

   /** @var string Contact's phone number */
   public string $phone_number;

   /** @var string Contact's first name */
   public string $first_name;

   /** @var string|null Contact's last name */
   public ?string $last_name = null;

   /** @var string|null Additional data about the contact in the form of a vCard, 0-2048 bytes */
   public ?string $vcard = null;

   /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
   public ?InlineKeyboardMarkup $reply_markup = null;

   /** @var InputMessageContent|null Content of the message to be sent instead of the contact */
   public ?InputMessageContent $input_message_content = null;

   /** @var string|null Url of the thumbnail for the result */
   public ?string $thumb_url = null;

   /** @var int|null Thumbnail width */
   public ?int $thumb_width = null;

   /** @var int|null Thumbnail height */
   public ?int $thumb_height = null;


}

?>
