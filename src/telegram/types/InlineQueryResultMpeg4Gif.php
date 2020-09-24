<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents a link to a video animation (H.264/MPEG-4 AVC video without sound). By default, this animated MPEG-4 file will be sent by the user with optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the animation.
*/
class InlineQueryResultMpeg4Gif extends \Telegram\InlineQueryResultMpeg4Gif{

   /** @var string Type of the result, must be video */
   public string $type;

   /** @var string Unique identifier for this result, 1-64 bytes */
   public string $id;

   /** @var string A valid URL for the embedded video player or video file */
   public string $video_url;

   /** @var string Mime type of the content of video url, “text/html” or “video/mp4” */
   public string $mime_type;

   /** @var string URL of the thumbnail (jpeg only) for the video */
   public string $thumb_url;

   /** @var string Title for the result */
   public string $title;

   /** @var string|null Caption of the video to be sent, 0-1024 characters after entities parsing */
   public ?string $caption = null;

   /** @var string|null Mode for parsing entities in the video caption. See formatting options for more details. */
   public ?string $parse_mode = null;

   /** @var int|null Video width */
   public ?int $video_width = null;

   /** @var int|null Video height */
   public ?int $video_height = null;

   /** @var int|null Video duration in seconds */
   public ?int $video_duration = null;

   /** @var string|null Short description of the result */
   public ?string $description = null;

   /** @var InlineKeyboardMarkup|null Inline keyboard attached to the message */
   public ?InlineKeyboardMarkup $reply_markup = null;

   /** @var InputMessageContent|null Content of the message to be sent instead of the video. This field is required if InlineQueryResultVideo is used to send an HTML-page as a result (e.g., a YouTube video). */
   public ?InputMessageContent $input_message_content = null;


}

?>
