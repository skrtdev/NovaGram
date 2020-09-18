<?php

namespace skrtdev\Prototypes;

class Prototype{

    public static array $methods = [];

    public static function addMethod(string $class_name, string $name, \Closure $fun){
        self::$methods[$class_name] ??= [];
        self::$methods[$class_name][$name] = $fun;
    }

    public static function call(string $class_name, string $name, array $args, object $obj){
        self::$methods[$class_name] ??= [];
        if(isset(self::$methods[$class_name][$name])){
            return (self::$methods[$class_name][$name])($obj, ...$args);
        }
        else{
            throw new \Error("Call to undefined method $class_name::$name()");
        }
    }

}

?>
