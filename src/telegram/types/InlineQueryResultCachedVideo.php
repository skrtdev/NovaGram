<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents a link to a video file stored on the Telegram servers. By default, this video file will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the video.
*/
class InlineQueryResultCachedVideo extends \Telegram\InlineQueryResultCachedVideo{

   /** @var string Type of the result, must be voice */
   public string $type;

   /** @var string Unique identifier for this result, 1-64 bytes */
   public string $id;

   /** @var string A valid file identifier for the voice message */
   public string $voice_file_id;

   /** @var string Voice message title */
   public string $title;

   /** @var string|null Caption, 0-1024 characters after entities parsing */
   public ?string $caption = null;

   /** @var string|null Mode for parsing entities in the voice message caption. See formatting options for more details. */
   public ?string $parse_mode = null;

   /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
   public ?InlineKeyboardMarkup $reply_markup = null;

   /** @var InputMessageContent|null Content of the message to be sent instead of the voice message */
   public ?InputMessageContent $input_message_content = null;


}

?>
