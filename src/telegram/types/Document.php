<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents a general file (as opposed to photos, voice messages and audio files).
*/
class Document extends \Telegram\Document{

    /** @var string Identifier for this file, which can be used to download or reuse the file */
    public string $file_id;

    /** @var string Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file. */
    public string $file_unique_id;

    /** @var PhotoSize|null Document thumbnail as defined by sender */
    public ?PhotoSize $thumb = null;

    /** @var string|null Original filename as defined by sender */
    public ?string $file_name = null;

    /** @var string|null MIME type of the file as defined by sender */
    public ?string $mime_type = null;

    /** @var int|null File size */
    public ?int $file_size = null;

    
}

?>
