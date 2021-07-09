<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents the contents of a file to be uploaded. Must be posted using multipart/form-data in the usual way that files are uploaded via the browser.
*/
class InputFile extends Type{
    
    
    public function __construct(array $array, Bot $Bot = null){
        parent::__construct($array, $Bot);
    }
    
    
}
