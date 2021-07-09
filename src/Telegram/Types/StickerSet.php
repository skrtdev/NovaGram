<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents a sticker set.
*/
class StickerSet extends Type{
    
    /** @var string Sticker set name */
    public string $name;

    /** @var string Sticker set title */
    public string $title;

    /** @var bool True, if the sticker set contains animated stickers */
    public bool $is_animated;

    /** @var bool True, if the sticker set contains masks */
    public bool $contains_masks;

    /** @var ObjectsList List of all set stickers */
    public ObjectsList $stickers;

    /** @var PhotoSize|null Sticker set thumbnail in the .WEBP or .TGS format */
    public ?PhotoSize $thumb = null;

    public function __construct(array $array, Bot $Bot = null){
        $this->name = $array['name'];
        $this->title = $array['title'];
        $this->is_animated = $array['is_animated'];
        $this->contains_masks = $array['contains_masks'];
        $this->stickers = new ObjectsList(iterate($array['stickers'], fn($item) => new Sticker($item, $Bot)));
        $this->thumb = isset($array['thumb']) ? new PhotoSize($array['thumb'], $Bot) : null;
        parent::__construct($array, $Bot);
    }
    
    
}
