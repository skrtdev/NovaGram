<?php

namespace skrtdev\Prototypes;

use Closure;

interface Prototypeable{

    public function __call(string $name, array $args);

    public static function addMethod(string $name, Closure $fun);

}

?>
