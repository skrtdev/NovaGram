<?php

class TelegramBot extends \Telegram\Bot{
    public function __construct(...$args){
        trigger_error('Using deprecated '.self::class.', use \\'.parent::class.' instead');
        parent::__construct(...$args);
    }
}

?>
