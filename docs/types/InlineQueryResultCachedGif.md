# InlineQueryResultCachedGif	

Represents a link to an animated GIF file stored on the Telegram servers. By default, this animated GIF file will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with specified content instead of the animation.	

## Properties	

- `$type`: _Type of the result, must be gif_
- `$id`: _Unique identifier for this result, 1-64 bytes_
- `$gif_file_id`: _A valid file identifier for the GIF file_
- `$title`: _Optional. Title for the result_
- `$caption`: _Optional. Caption of the GIF file to be sent, 0-1024 characters after entities parsing_
- `$parse_mode`: _Optional. Mode for parsing entities in the caption. See formatting options for more details._
- `$caption_entities`: [`Array of MessageEntity`](MessageEntity.md) _Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode_
- `$reply_markup`: [`InlineKeyboardMarkup`](InlineKeyboardMarkup.md) _Optional. Inline keyboard attached to the message_
- `$input_message_content`: [`InputMessageContent`](InputMessageContent.md) _Optional. Content of the message to be sent instead of the GIF animation_

## Methods	
