# Audio	

This object represents an audio file to be treated as music by the Telegram clients.	

## Properties	

- `$file_id`: _Identifier for this file, which can be used to download or reuse the file_
- `$file_unique_id`: _Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file._
- `$duration`: _Duration of the audio in seconds as defined by sender_
- `$performer`: _Optional. Performer of the audio as defined by sender or by audio tags_
- `$title`: _Optional. Title of the audio as defined by sender or by audio tags_
- `$file_name`: _Optional. Original filename as defined by sender_
- `$mime_type`: _Optional. MIME type of the file as defined by sender_
- `$file_size`: _Optional. File size_
- `$thumb`: [`PhotoSize`](PhotoSize.md) _Optional. Thumbnail of the album cover to which the music file belongs_

## Methods	
