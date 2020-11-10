<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents a sticker set.
*/
class StickerSet extends \Telegram\StickerSet{

    use simpleProto;

    /** @var string Sticker set name */
    public string $name;

    /** @var string Sticker set title */
    public string $title;

    /** @var bool True, if the sticker set contains animated stickers */
    public bool $is_animated;

    /** @var bool True, if the sticker set contains masks */
    public bool $contains_masks;

    /** @var stdClass List of all set stickers */
    public stdClass $stickers;

    /** @var PhotoSize|null Sticker set thumbnail in the .WEBP or .TGS format */
    public ?PhotoSize $thumb = null;

    
}

?>
