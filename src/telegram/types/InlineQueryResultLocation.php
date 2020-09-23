<?php

namespace skrtdev\Telegram;

use \stdClass;

class InlineQueryResultLocation extends \Telegram\InlineQueryResultLocation{

   public string $type;
   public string $id;
   public float $latitude;
   public float $longitude;
   public string $title;
   public string $address;
   public ?string $foursquare_id;
   public ?string $foursquare_type;
   public ?InlineKeyboardMarkup $reply_markup;
   public ?InputMessageContent $input_message_content;
   public ?string $thumb_url;
   public ?int $thumb_width;
   public ?int $thumb_height;

}

?>