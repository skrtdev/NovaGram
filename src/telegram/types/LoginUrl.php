<?php

namespace skrtdev\Telegram;

use \stdClass;

class LoginUrl extends \Telegram\LoginUrl{

   public string $url;
   public ?string $forward_text;
   public ?string $bot_username;
   public ?bool $request_write_access;

}

?>