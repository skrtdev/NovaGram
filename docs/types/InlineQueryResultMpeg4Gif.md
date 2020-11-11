# InlineQueryResultMpeg4Gif	

Represents a link to a video animation (H.264/MPEG-4 AVC video without sound). By default, this animated MPEG-4 file will be sent by the user with optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the animation.	

## Properties	

- `$type`: _Type of the result, must be mpeg4_gif_
- `$id`: _Unique identifier for this result, 1-64 bytes_
- `$mpeg4_url`: _A valid URL for the MP4 file. File size must not exceed 1MB_
- `$mpeg4_width`: _Optional. Video width_
- `$mpeg4_height`: _Optional. Video height_
- `$mpeg4_duration`: _Optional. Video duration_
- `$thumb_url`: _URL of the static (JPEG or GIF) or animated (MPEG4) thumbnail for the result_
- `$thumb_mime_type`: _Optional. MIME type of the thumbnail, must be one of “image/jpeg”, “image/gif”, or “video/mp4”. Defaults to “image/jpeg”_
- `$title`: _Optional. Title for the result_
- `$caption`: _Optional. Caption of the MPEG-4 file to be sent, 0-1024 characters after entities parsing_
- `$parse_mode`: _Optional. Mode for parsing entities in the caption. See formatting options for more details._
- `$caption_entities`: [`Array of MessageEntity`](MessageEntity.md) _Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode_
- `$reply_markup`: [`InlineKeyboardMarkup`](InlineKeyboardMarkup.md) _Optional. Inline keyboard attached to the message_
- `$input_message_content`: [`InputMessageContent`](InputMessageContent.md) _Optional. Content of the message to be sent instead of the video animation_

## Methods	
