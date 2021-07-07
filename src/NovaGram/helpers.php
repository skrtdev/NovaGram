<?php

use skrtdev\NovaGram\Dispatcher;

if(!function_exists('stop_handling')){
    function stop_handling(): void {
        Dispatcher::stopHandling();
    }
}
else throw new skrtdev\NovaGram\Exception('stop_handling function already exist');

if(!function_exists('iterate')){
    function iterate(iterable $list, callable $callable): array {
        $result = [];
        foreach ($list as $key => $item) {
            $result []= $callable(...is_integer($key) ? [$item] : [$key, $item]);
        }
        return $result;
    }
}
else throw new skrtdev\NovaGram\Exception('iterate function already exist');

if(!function_exists('random_string')){
    function random_string(int $length = 10): string {
        $characters = str_split('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        shuffle($characters);
        return substr(implode($characters), 0, $length);
    }

}
else throw new skrtdev\NovaGram\Exception('random_string function already exist');


if(!function_exists('is_list')){
    function is_list(array $array): bool {
        return $array === array_values($array);
    }
}
else throw new skrtdev\NovaGram\Exception('is_list function already exist');

if(!function_exists('button')){
    function button(string $text, string $data, bool $is_url = false): array {
        return ['text' => $text, $is_url ? 'url' : 'callback_data' => $data];
    }
}
