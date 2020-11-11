# Animation	

This object represents an animation file (GIF or H.264/MPEG-4 AVC video without sound).	

## Properties	

- `$file_id`: _Identifier for this file, which can be used to download or reuse the file_
- `$file_unique_id`: _Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file._
- `$width`: _Video width as defined by sender_
- `$height`: _Video height as defined by sender_
- `$duration`: _Duration of the video in seconds as defined by sender_
- `$thumb`: [`PhotoSize`](PhotoSize.md) _Optional. Animation thumbnail as defined by sender_
- `$file_name`: _Optional. Original animation filename as defined by sender_
- `$mime_type`: _Optional. MIME type of the file as defined by sender_
- `$file_size`: _Optional. File size_

## Methods	
