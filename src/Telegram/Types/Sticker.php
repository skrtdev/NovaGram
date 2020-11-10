<?php

namespace skrtdev\Telegram;

use stdClass;
use skrtdev\Prototypes\simpleProto;

/**
 * This object represents a sticker.
*/
class Sticker extends \Telegram\Sticker{

    use simpleProto;

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

    /** @var int|null File size */
    public ?int $file_size = null;

    
}

?>
