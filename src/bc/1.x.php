<?php

namespace Telegram;

class Bot extends \NovaGram\Bot{
    public function __construct(...$args){
        trigger_error('Using deprecated '.self::class.', use \\'.parent::class.' instead');
        parent::__construct(...$args);
        $this->json_payload = false;
    }
}


?>
