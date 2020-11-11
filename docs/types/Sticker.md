# Sticker	

This object represents a sticker.	

## Properties	

- `$file_id`: _Identifier for this file, which can be used to download or reuse the file_
- `$file_unique_id`: _Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file._
- `$width`: _Sticker width_
- `$height`: _Sticker height_
- `$is_animated`: _True, if the sticker is animated_
- `$thumb`: [`PhotoSize`](PhotoSize.md) _Optional. Sticker thumbnail in the .WEBP or .JPG format_
- `$emoji`: _Optional. Emoji associated with the sticker_
- `$set_name`: _Optional. Name of the sticker set to which the sticker belongs_
- `$mask_position`: [`MaskPosition`](MaskPosition.md) _Optional. For mask stickers, the position where the mask should be placed_
- `$file_size`: _Optional. File size_

## Methods	
