<?php

namespace skrtdev\Prototypes;

trait simpleProto{
    public static function addMethod(string $name, \Closure $fun){
        return Prototype::addMethod(__CLASS__, $name, $fun);
    }
}

?>
