<?php

namespace skrtdev\Telegram;

use \stdClass;

class WebhookInfo extends \Telegram\WebhookInfo{

   public string $url;
   public bool $has_custom_certificate;
   public int $pending_update_count;
   public ?int $last_error_date;
   public ?string $last_error_message;
   public ?int $max_connections;
   public ?stdClass $allowed_updates;

}

?>