# InlineQueryResultVoice	

Represents a link to a voice recording in an .OGG container encoded with OPUS. By default, this voice recording will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the the voice message.	

## Properties	

- `$type`: _Type of the result, must be voice_
- `$id`: _Unique identifier for this result, 1-64 bytes_
- `$voice_url`: _A valid URL for the voice recording_
- `$title`: _Recording title_
- `$caption`: _Optional. Caption, 0-1024 characters after entities parsing_
- `$parse_mode`: _Optional. Mode for parsing entities in the voice message caption. See formatting options for more details._
- `$caption_entities`: [`Array of MessageEntity`](MessageEntity.md) _Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode_
- `$voice_duration`: _Optional. Recording duration in seconds_
- `$reply_markup`: [`InlineKeyboardMarkup`](InlineKeyboardMarkup.md) _Optional. Inline keyboard attached to the message_
- `$input_message_content`: [`InputMessageContent`](InputMessageContent.md) _Optional. Content of the message to be sent instead of the voice recording_

## Methods	
