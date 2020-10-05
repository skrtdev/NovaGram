<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Represents an audio file to be treated as music to be sent.
*/
class InputMediaAudio extends \Telegram\InputMediaAudio{

    /** @var string Type of the result, must be audio */
    public string $type;

    /** @var string File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. More info on Sending Files » */
    public string $media;

    /** @var InputFile|string|null Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More info on Sending Files » */
    public $thumb = null;

    /** @var string|null Caption of the audio to be sent, 0-1024 characters after entities parsing */
    public ?string $caption = null;

    /** @var string|null Mode for parsing entities in the audio caption. See formatting options for more details. */
    public ?string $parse_mode = null;

    /** @var int|null Duration of the audio in seconds */
    public ?int $duration = null;

    /** @var string|null Performer of the audio */
    public ?string $performer = null;

    /** @var string|null Title of the audio */
    public ?string $title = null;

    
}

?>
