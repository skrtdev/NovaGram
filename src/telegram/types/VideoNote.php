<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents a video message (available in Telegram apps as of v.4.0).
*/
class VideoNote extends \Telegram\VideoNote{

    /** @var string Identifier for this file, which can be used to download or reuse the file */
    public string $file_id;

    /** @var string Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file. */
    public string $file_unique_id;

    /** @var int Video width and height (diameter of the video message) as defined by sender */
    public int $length;

    /** @var int Duration of the video in seconds as defined by sender */
    public int $duration;

    /** @var PhotoSize|null Video thumbnail */
    public ?PhotoSize $thumb = null;

    /** @var int|null File size */
    public ?int $file_size = null;

    
}

?>
