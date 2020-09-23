<?php

namespace skrtdev\Telegram;

use \stdClass;

class Sticker extends \Telegram\Sticker{

   public string $name;
   public string $title;
   public bool $is_animated;
   public bool $contains_masks;
   public stdClass $stickers;
   public ?PhotoSize $thumb;

}

?>