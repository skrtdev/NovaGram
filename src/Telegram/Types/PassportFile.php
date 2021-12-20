<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a file uploaded to Telegram Passport. Currently all Telegram Passport files are in JPEG format when decrypted and don't exceed 10MB.
*/
class PassportFile extends Type{
    
    /** @var string Identifier for this file, which can be used to download or reuse the file */
    public string $file_id;

    /** @var string Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file. */
    public string $file_unique_id;

    /** @var int File size in bytes */
    public int $file_size;

    /** @var int Unix time when the file was uploaded */
    public int $file_date;

    public function __construct(array $array, Bot $Bot = null){
        $this->file_id = $array['file_id'];
        $this->file_unique_id = $array['file_unique_id'];
        $this->file_size = $array['file_size'];
        $this->file_date = $array['file_date'];
        parent::__construct($array, $Bot);
    }
    
    
}
