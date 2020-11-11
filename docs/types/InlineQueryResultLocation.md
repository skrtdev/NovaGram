# InlineQueryResultLocation	

Represents a location on a map. By default, the location will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the location.	

## Properties	

- `$type`: _Type of the result, must be location_
- `$id`: _Unique identifier for this result, 1-64 Bytes_
- `$latitude`: _Location latitude in degrees_
- `$longitude`: _Location longitude in degrees_
- `$title`: _Location title_
- `$horizontal_accuracy`: _Optional. The radius of uncertainty for the location, measured in meters; 0-1500_
- `$live_period`: _Optional. Period in seconds for which the location can be updated, should be between 60 and 86400._
- `$heading`: _Optional. For live locations, a direction in which the user is moving, in degrees. Must be between 1 and 360 if specified._
- `$proximity_alert_radius`: _Optional. For live locations, a maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified._
- `$reply_markup`: [`InlineKeyboardMarkup`](InlineKeyboardMarkup.md) _Optional. Inline keyboard attached to the message_
- `$input_message_content`: [`InputMessageContent`](InputMessageContent.md) _Optional. Content of the message to be sent instead of the location_
- `$thumb_url`: _Optional. Url of the thumbnail for the result_
- `$thumb_width`: _Optional. Thumbnail width_
- `$thumb_height`: _Optional. Thumbnail height_

## Methods	
