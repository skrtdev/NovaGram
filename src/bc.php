<?php

class TelegramBot extends \Telegram\Bot{
    public function __construct(...$args){
        trigger_error('Using deprecated '.self::class.', use \\'.parent::class.' instead');
        parent::__construct(...$args);
    }
}

class TelegramObject extends \Telegram\Type{
    public function __construct(...$args){
        trigger_error('Using deprecated '.self::class.', use \\'.parent::class.' instead');
        parent::__construct(...$args);
    }
}

class TelegramException extends \Telegram\Exception{
    public function __construct(...$args){
        trigger_error('Using deprecated '.self::class.', use \\'.parent::class.' instead');
        parent::__construct(...$args);
    }
}

?>
