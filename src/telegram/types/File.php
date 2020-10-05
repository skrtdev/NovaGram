<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents a file ready to be downloaded. The file can be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile.
*/
class File extends \Telegram\File{

    /** @var string Identifier for this file, which can be used to download or reuse the file */
    public string $file_id;

    /** @var string Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file. */
    public string $file_unique_id;

    /** @var int|null File size, if known */
    public ?int $file_size = null;

    /** @var string|null File path. Use https://api.telegram.org/file/bot<token>/<file_path> to get the file. */
    public ?string $file_path = null;

    
}

?>
