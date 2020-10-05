<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents a video file.
*/
class Video extends \Telegram\Video{

    /** @var string Identifier for this file, which can be used to download or reuse the file */
    public string $file_id;

    /** @var string Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file. */
    public string $file_unique_id;

    /** @var int Video width as defined by sender */
    public int $width;

    /** @var int Video height as defined by sender */
    public int $height;

    /** @var int Duration of the video in seconds as defined by sender */
    public int $duration;

    /** @var PhotoSize|null Video thumbnail */
    public ?PhotoSize $thumb = null;

    /** @var string|null Mime type of a file as defined by sender */
    public ?string $mime_type = null;

    /** @var int|null File size */
    public ?int $file_size = null;

    
}

?>
