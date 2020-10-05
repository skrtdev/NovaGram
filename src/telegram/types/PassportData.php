<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * Contains information about Telegram Passport data shared with the bot by the user.
*/
class PassportData extends \Telegram\PassportData{

    /** @var string Identifier for this file, which can be used to download or reuse the file */
    public string $file_id;

    /** @var string Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file. */
    public string $file_unique_id;

    /** @var int File size */
    public int $file_size;

    /** @var int Unix time when the file was uploaded */
    public int $file_date;

    
}

?>
