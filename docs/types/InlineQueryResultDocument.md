# InlineQueryResultDocument	

Represents a link to a file. By default, this file will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the file. Currently, only .PDF and .ZIP files can be sent using this method.	

## Properties	

- `$type`: _Type of the result, must be document_
- `$id`: _Unique identifier for this result, 1-64 bytes_
- `$title`: _Title for the result_
- `$caption`: _Optional. Caption of the document to be sent, 0-1024 characters after entities parsing_
- `$parse_mode`: _Optional. Mode for parsing entities in the document caption. See formatting options for more details._
- `$caption_entities`: [`Array of MessageEntity`](MessageEntity.md) _Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode_
- `$document_url`: _A valid URL for the file_
- `$mime_type`: _Mime type of the content of the file, either “application/pdf” or “application/zip”_
- `$description`: _Optional. Short description of the result_
- `$reply_markup`: [`InlineKeyboardMarkup`](InlineKeyboardMarkup.md) _Optional. Inline keyboard attached to the message_
- `$input_message_content`: [`InputMessageContent`](InputMessageContent.md) _Optional. Content of the message to be sent instead of the file_
- `$thumb_url`: _Optional. URL of the thumbnail (jpeg only) for the file_
- `$thumb_width`: _Optional. Thumbnail width_
- `$thumb_height`: _Optional. Thumbnail height_

## Methods	
