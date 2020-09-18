<?php

namespace skrtdev\Prototypes;

trait proto{
    public function __call(string $name, array $args){
        Prototype::call(__CLASS__, $name, $args, $this);
    }
}

?>
