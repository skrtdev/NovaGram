<?php

use skrtdev\NovaGram\Dispatcher;

if(!function_exists('stop_update_propagation')){
    function stop_update_propagation(){
        Dispatcher::stopUpdatePropagation();
    }
}
