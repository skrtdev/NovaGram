# Document	

This object represents a general file (as opposed to photos, voice messages and audio files).	

## Properties	

- `$file_id`: _Identifier for this file, which can be used to download or reuse the file_
- `$file_unique_id`: _Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file._
- `$thumb`: [`PhotoSize`](PhotoSize.md) _Optional. Document thumbnail as defined by sender_
- `$file_name`: _Optional. Original filename as defined by sender_
- `$mime_type`: _Optional. MIME type of the file as defined by sender_
- `$file_size`: _Optional. File size_

## Methods	

### get()	

Alias of [`getFile`](../methods.md#getFile)	
_A description of the method_	

```
$document->get(...$args);
```