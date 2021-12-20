<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a sticker.
*/
class Sticker extends Type{
    
    /** @var string Identifier for this file, which can be used to download or reuse the file */
    public string $file_id;

    /** @var string Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file. */
    public string $file_unique_id;

    /** @var int Sticker width */
    public int $width;

    /** @var int Sticker height */
    public int $height;

    /** @var bool True, if the sticker is animated */
    public bool $is_animated;

    /** @var PhotoSize|null Sticker thumbnail in the .WEBP or .JPG format */
    public ?PhotoSize $thumb = null;

    /** @var string|null Emoji associated with the sticker */
    public ?string $emoji = null;

    /** @var string|null Name of the sticker set to which the sticker belongs */
    public ?string $set_name = null;

    /** @var MaskPosition|null For mask stickers, the position where the mask should be placed */
    public ?MaskPosition $mask_position = null;

    /** @var int|null File size in bytes */
    public ?int $file_size = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->file_id = $array['file_id'];
        $this->file_unique_id = $array['file_unique_id'];
        $this->width = $array['width'];
        $this->height = $array['height'];
        $this->is_animated = $array['is_animated'];
        $this->thumb = isset($array['thumb']) ? new PhotoSize($array['thumb'], $Bot) : null;
        $this->emoji = $array['emoji'] ?? null;
        $this->set_name = $array['set_name'] ?? null;
        $this->mask_position = isset($array['mask_position']) ? new MaskPosition($array['mask_position'], $Bot) : null;
        $this->file_size = $array['file_size'] ?? null;
        parent::__construct($array, $Bot);
    }
    
    
}
