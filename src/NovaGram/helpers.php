<?php

use skrtdev\NovaGram\{Dispatcher, Utils};

if(!function_exists('stop_handling')){
    function stop_handling(){
        Dispatcher::stopHandling();
    }
}


if(!function_exists('iterate')){
    function iterate(array $list, callable $callable): array {
        $result = [];
        foreach ($list as $item) {
            $result []= $callable($item);
        }
        return $result;
    }
}
else throw new skrtdev\NovaGram\Exception('iterate function already exist');
