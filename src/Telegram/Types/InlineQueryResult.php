<?php

namespace skrtdev\Telegram;

use skrtdev\NovaGram\Bot;

/**
 * This object represents one result of an inline query. Telegram clients currently support results of the following 20 types:
Note: All URLs passed in inline query results will be available to end users and therefore must be assumed to be public.
*/
class InlineQueryResult extends Type{
    
    protected string $_ = 'InlineQueryResult';

    
    public function __construct(array $array, Bot $Bot = null){
        parent::__construct($array, $Bot);
   }
    
}
