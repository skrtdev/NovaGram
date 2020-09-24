<?php

namespace skrtdev\Telegram;

use \stdClass;

/**
 * This object represents one size of a photo or a file / sticker thumbnail.
*/
class PhotoSize extends \Telegram\PhotoSize{

   /** @var string Identifier for this file, which can be used to download or reuse the file */
   public string $file_id;

   /** @var string Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file. */
   public string $file_unique_id;

   /** @var int Photo width */
   public int $width;

   /** @var int Photo height */
   public int $height;

   /** @var int|null File size */
   public ?int $file_size = null;


}

?>
