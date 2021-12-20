<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a general file (as opposed to photos, voice messages and audio files).
*/
class Document extends Type{
    
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

    /** @var int|null File size in bytes */
    public ?int $file_size = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->file_id = $array['file_id'];
        $this->file_unique_id = $array['file_unique_id'];
        $this->thumb = isset($array['thumb']) ? new PhotoSize($array['thumb'], $Bot) : null;
        $this->file_name = $array['file_name'] ?? null;
        $this->mime_type = $array['mime_type'] ?? null;
        $this->file_size = $array['file_size'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    public function get(): ?\skrtdev\Telegram\File
    {
        return $this->Bot->getFile(['file_id' => $this->file_id]);
    }
}
