<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents an audio file to be treated as music by the Telegram clients.
*/
class Audio extends Type{
    
    /** @var string Identifier for this file, which can be used to download or reuse the file */
    public string $file_id;

    /** @var string Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file. */
    public string $file_unique_id;

    /** @var int Duration of the audio in seconds as defined by sender */
    public int $duration;

    /** @var string|null Performer of the audio as defined by sender or by audio tags */
    public ?string $performer = null;

    /** @var string|null Title of the audio as defined by sender or by audio tags */
    public ?string $title = null;

    /** @var string|null Original filename as defined by sender */
    public ?string $file_name = null;

    /** @var string|null MIME type of the file as defined by sender */
    public ?string $mime_type = null;

    /** @var int|null File size in bytes */
    public ?int $file_size = null;

    /** @var PhotoSize|null Thumbnail of the album cover to which the music file belongs */
    public ?PhotoSize $thumb = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->file_id = $array['file_id'];
        $this->file_unique_id = $array['file_unique_id'];
        $this->duration = $array['duration'];
        $this->performer = $array['performer'] ?? null;
        $this->title = $array['title'] ?? null;
        $this->file_name = $array['file_name'] ?? null;
        $this->mime_type = $array['mime_type'] ?? null;
        $this->file_size = $array['file_size'] ?? null;
        $this->thumb = isset($array['thumb']) ? new PhotoSize($array['thumb'], $Bot) : null;
        parent::__construct($array, $Bot);
    }
    
    
}
