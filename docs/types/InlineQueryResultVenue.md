# InlineQueryResultVenue	

Represents a venue. By default, the venue will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the venue.	

## Properties	

- `$type`: _Type of the result, must be venue_
- `$id`: _Unique identifier for this result, 1-64 Bytes_
- `$latitude`: _Latitude of the venue location in degrees_
- `$longitude`: _Longitude of the venue location in degrees_
- `$title`: _Title of the venue_
- `$address`: _Address of the venue_
- `$foursquare_id`: _Optional. Foursquare identifier of the venue if known_
- `$foursquare_type`: _Optional. Foursquare type of the venue, if known. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)_
- `$google_place_id`: _Optional. Google Places identifier of the venue_
- `$google_place_type`: _Optional. Google Places type of the venue. (See supported types.)_
- `$reply_markup`: [`InlineKeyboardMarkup`](InlineKeyboardMarkup.md) _Optional. Inline keyboard attached to the message_
- `$input_message_content`: [`InputMessageContent`](InputMessageContent.md) _Optional. Content of the message to be sent instead of the venue_
- `$thumb_url`: _Optional. Url of the thumbnail for the result_
- `$thumb_width`: _Optional. Thumbnail width_
- `$thumb_height`: _Optional. Thumbnail height_

## Methods	
