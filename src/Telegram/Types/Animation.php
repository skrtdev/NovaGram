<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents an animation file (GIF or H.264/MPEG-4 AVC video without sound).
*/
class Animation extends Type{
    
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

    /** @var PhotoSize|null Animation thumbnail as defined by sender */
    public ?PhotoSize $thumb = null;

    /** @var string|null Original animation filename as defined by sender */
    public ?string $file_name = null;

    /** @var string|null MIME type of the file as defined by sender */
    public ?string $mime_type = null;

    /** @var int|null File size in bytes */
    public ?int $file_size = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->file_id = $array['file_id'];
        $this->file_unique_id = $array['file_unique_id'];
        $this->width = $array['width'];
        $this->height = $array['height'];
        $this->duration = $array['duration'];
        $this->thumb = isset($array['thumb']) ? new PhotoSize($array['thumb'], $Bot) : null;
        $this->file_name = $array['file_name'] ?? null;
        $this->mime_type = $array['mime_type'] ?? null;
        $this->file_size = $array['file_size'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
