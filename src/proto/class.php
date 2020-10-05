<?php

namespace skrtdev\Prototypes;

class Prototype{

    public static array $methods = [];

    public static function addMethod(string $class_name, string $name, \Closure $fun): bool{
        self::$methods[$class_name] ??= [];
        self::$methods[$class_name][$name] = $fun;
        return true;
    }

    public static function call(object $obj, string $name, array $args){
        $class_name = get_class($obj);
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
