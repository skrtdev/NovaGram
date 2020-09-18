<?php

namespace Telegram;

class Bot extends \skrtdev\NovaGram\Bot{
    public function __construct(...$args){
        \skrtdev\NovaGram\Utils::trigger_error('Using deprecated '.self::class.', use \\'.parent::class.' instead', E_USER_DEPRECATED);
        parent::__construct(...$args);
    }
}


?>
