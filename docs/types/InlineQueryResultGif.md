# InlineQueryResultGif	

Represents a link to an animated GIF file. By default, this animated GIF file will be sent by the user with optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the animation.	

## Properties	

- `$type`: _Type of the result, must be gif_
- `$id`: _Unique identifier for this result, 1-64 bytes_
- `$gif_url`: _A valid URL for the GIF file. File size must not exceed 1MB_
- `$gif_width`: _Optional. Width of the GIF_
- `$gif_height`: _Optional. Height of the GIF_
- `$gif_duration`: _Optional. Duration of the GIF_
- `$thumb_url`: _URL of the static (JPEG or GIF) or animated (MPEG4) thumbnail for the result_
- `$thumb_mime_type`: _Optional. MIME type of the thumbnail, must be one of “image/jpeg”, “image/gif”, or “video/mp4”. Defaults to “image/jpeg”_
- `$title`: _Optional. Title for the result_
- `$caption`: _Optional. Caption of the GIF file to be sent, 0-1024 characters after entities parsing_
- `$parse_mode`: _Optional. Mode for parsing entities in the caption. See formatting options for more details._
- `$caption_entities`: [`Array of MessageEntity`](MessageEntity.md) _Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode_
- `$reply_markup`: [`InlineKeyboardMarkup`](InlineKeyboardMarkup.md) _Optional. Inline keyboard attached to the message_
- `$input_message_content`: [`InputMessageContent`](InputMessageContent.md) _Optional. Content of the message to be sent instead of the GIF animation_

## Methods	
