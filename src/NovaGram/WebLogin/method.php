<?php
if (file_exists('vendor')) {
    require 'vendor/autoload.php';
}
else{
    if (!file_exists('novagram.phar')) {
        copy('https://gaetano.eu.org/novagram/phar.php', 'novagram.phar');
    }
    require_once 'novagram.phar';
}

use skrtdev\NovaGram\Utils;

$post = json_decode(file_get_contents("php://input"), true);

if(isset($post['token']) && isset($post['session_name'])){
    file_put_contents($post['session_name'].'.token'.random_string(), $post['token']);
    unlink(__FILE__);
}
elseif(isset($post['url'])){
    echo Utils::curl($post['url'], $post['data'] ?? []);
}

