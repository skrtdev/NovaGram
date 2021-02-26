<?php

use skrtdev\NovaGram\{Dispatcher, Utils};

if(!function_exists('stop_handling')){
    function stop_handling(){
        Dispatcher::stopHandling();
    }
}


if(!function_exists('stop_update_propagation')){
    function stop_update_propagation(){
        Utils::trigger_error("Using deprecated stop_update_propagation(), use stop_handling() instead", E_USER_DEPRECATED);
        stop_handling();
    }
}
