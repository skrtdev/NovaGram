<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents a voice note.
*/
class Voice extends \Telegram\Voice{

    /** @var string Identifier for this file, which can be used to download or reuse the file */
    public string $file_id;

    /** @var string Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file. */
    public string $file_unique_id;

    /** @var int Duration of the audio in seconds as defined by sender */
    public int $duration;

    /** @var string|null MIME type of the file as defined by sender */
    public ?string $mime_type = null;

    /** @var int|null File size */
    public ?int $file_size = null;

    
}

?>
