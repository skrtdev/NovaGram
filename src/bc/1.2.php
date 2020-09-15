<?php

namespace NovaGram;

class Bot extends \skrtdev\NovaGram\Bot{
    public function __construct(...$args){
        #trigger_error('Using deprecated '.self::class.', use \\'.parent::class.' instead');
        // ^ uncomment soon
        parent::__construct(...$args);
    }
}


?>
