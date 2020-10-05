<?php

namespace skrtdev\Prototypes;

trait proto{
    public function __call(string $name, array $args){
        return Prototype::call($this, $name, $args);
    }

    public static function addMethod(string $name, \Closure $fun){
        return Prototype::addMethod(get_class($this), $name, $fun);
    }
}

?>
