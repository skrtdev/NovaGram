# InlineQueryResultCachedSticker	

Represents a link to a sticker stored on the Telegram servers. By default, this sticker will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the sticker.	

## Properties	

- `$type`: _Type of the result, must be sticker_
- `$id`: _Unique identifier for this result, 1-64 bytes_
- `$sticker_file_id`: _A valid file identifier of the sticker_
- `$reply_markup`: [`InlineKeyboardMarkup`](InlineKeyboardMarkup.md) _Optional. Inline keyboard attached to the message_
- `$input_message_content`: [`InputMessageContent`](InputMessageContent.md) _Optional. Content of the message to be sent instead of the sticker_

## Methods	
