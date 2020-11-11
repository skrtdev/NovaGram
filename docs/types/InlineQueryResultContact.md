# InlineQueryResultContact	

Represents a contact with a phone number. By default, this contact will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the contact.	

## Properties	

- `$type`: _Type of the result, must be contact_
- `$id`: _Unique identifier for this result, 1-64 Bytes_
- `$phone_number`: _Contact's phone number_
- `$first_name`: _Contact's first name_
- `$last_name`: _Optional. Contact's last name_
- `$vcard`: _Optional. Additional data about the contact in the form of a vCard, 0-2048 bytes_
- `$reply_markup`: [`InlineKeyboardMarkup`](InlineKeyboardMarkup.md) _Optional. Inline keyboard attached to the message_
- `$input_message_content`: [`InputMessageContent`](InputMessageContent.md) _Optional. Content of the message to be sent instead of the contact_
- `$thumb_url`: _Optional. Url of the thumbnail for the result_
- `$thumb_width`: _Optional. Thumbnail width_
- `$thumb_height`: _Optional. Thumbnail height_

## Methods	
