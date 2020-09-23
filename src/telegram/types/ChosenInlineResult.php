<?php

namespace skrtdev\Telegram;

use \stdClass;

class ChosenInlineResult extends \Telegram\ChosenInlineResult{

   public int $chat_id;
   public string $title;
   public string $description;
   public string $payload;
   public string $provider_token;
   public string $start_parameter;
   public string $currency;
   public stdClass $prices;
   public string $provider_data;
   public string $photo_url;
   public int $photo_size;
   public int $photo_width;
   public int $photo_height;
   public bool $need_name;
   public bool $need_phone_number;
   public bool $need_email;
   public bool $need_shipping_address;
   public bool $send_phone_number_to_provider;
   public bool $send_email_to_provider;
   public bool $is_flexible;
   public bool $disable_notification;
   public int $reply_to_message_id;
   public InlineKeyboardMarkup $reply_markup;

}

?>