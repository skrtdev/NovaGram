# InlineQueryResultVideo	

Represents a link to a page containing an embedded video player or a video file. By default, this video file will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the video.	

## Properties	

- `$type`: _Type of the result, must be video_
- `$id`: _Unique identifier for this result, 1-64 bytes_
- `$video_url`: _A valid URL for the embedded video player or video file_
- `$mime_type`: _Mime type of the content of video url, “text/html” or “video/mp4”_
- `$thumb_url`: _URL of the thumbnail (jpeg only) for the video_
- `$title`: _Title for the result_
- `$caption`: _Optional. Caption of the video to be sent, 0-1024 characters after entities parsing_
- `$parse_mode`: _Optional. Mode for parsing entities in the video caption. See formatting options for more details._
- `$caption_entities`: [`Array of MessageEntity`](MessageEntity.md) _Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode_
- `$video_width`: _Optional. Video width_
- `$video_height`: _Optional. Video height_
- `$video_duration`: _Optional. Video duration in seconds_
- `$description`: _Optional. Short description of the result_
- `$reply_markup`: [`InlineKeyboardMarkup`](InlineKeyboardMarkup.md) _Optional. Inline keyboard attached to the message_
- `$input_message_content`: [`InputMessageContent`](InputMessageContent.md) _Optional. Content of the message to be sent instead of the video. This field is required if InlineQueryResultVideo is used to send an HTML-page as a result (e.g., a YouTube video)._

