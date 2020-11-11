# InlineQueryResultPhoto	

Represents a link to a photo. By default, this photo will be sent by the user with optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the photo.	

## Properties	

- `$type`: _Type of the result, must be photo_
- `$id`: _Unique identifier for this result, 1-64 bytes_
- `$photo_url`: _A valid URL of the photo. Photo must be in jpeg format. Photo size must not exceed 5MB_
- `$thumb_url`: _URL of the thumbnail for the photo_
- `$photo_width`: _Optional. Width of the photo_
- `$photo_height`: _Optional. Height of the photo_
- `$title`: _Optional. Title for the result_
- `$description`: _Optional. Short description of the result_
- `$caption`: _Optional. Caption of the photo to be sent, 0-1024 characters after entities parsing_
- `$parse_mode`: _Optional. Mode for parsing entities in the photo caption. See formatting options for more details._
- `$caption_entities`: [`Array of MessageEntity`](MessageEntity.md) _Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode_
- `$reply_markup`: [`InlineKeyboardMarkup`](InlineKeyboardMarkup.md) _Optional. Inline keyboard attached to the message_
- `$input_message_content`: [`InputMessageContent`](InputMessageContent.md) _Optional. Content of the message to be sent instead of the photo_

## Methods	
