<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents one size of a photo or a file / sticker thumbnail.
*/
class PhotoSize extends Type{
    
    /** @var string Identifier for this file, which can be used to download or reuse the file */
    public string $file_id;

    /** @var string Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file. */
    public string $file_unique_id;

    /** @var int Photo width */
    public int $width;

    /** @var int Photo height */
    public int $height;

    /** @var int|null File size in bytes */
    public ?int $file_size = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->file_id = $array['file_id'];
        $this->file_unique_id = $array['file_unique_id'];
        $this->width = $array['width'];
        $this->height = $array['height'];
        $this->file_size = $array['file_size'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
