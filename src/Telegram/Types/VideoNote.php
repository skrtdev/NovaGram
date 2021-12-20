<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a video message (available in Telegram apps as of v.4.0).
*/
class VideoNote extends Type{
    
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

    /** @var int|null File size in bytes */
    public ?int $file_size = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->file_id = $array['file_id'];
        $this->file_unique_id = $array['file_unique_id'];
        $this->length = $array['length'];
        $this->duration = $array['duration'];
        $this->thumb = isset($array['thumb']) ? new PhotoSize($array['thumb'], $Bot) : null;
        $this->file_size = $array['file_size'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
