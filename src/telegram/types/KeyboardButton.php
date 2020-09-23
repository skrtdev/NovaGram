<?php

namespace skrtdev\Telegram;

use \stdClass;

class KeyboardButton extends \Telegram\KeyboardButton{

   public string $text;
   public ?bool $request_contact;
   public ?bool $request_location;
   public ?KeyboardButtonPollType $request_poll;

}

?>