<?php

namespace NovaGram;

class Bot extends \skrtdev\NovaGram\Bot{
    public function __construct(...$args){
        \skrtdev\NovaGram\Utils::trigger_error('Using deprecated '.self::class.', use \\'.parent::class.' instead', E_USER_DEPRECATED);
        // ^ uncomment soon
        parent::__construct(...$args);
    }
}


?>
