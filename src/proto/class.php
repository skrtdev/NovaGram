<?php

namespace skrtdev\Prototypes;

use ReflectionFunction;

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
            $closure = self::$methods[$class_name][$name];

            $reflection = new ReflectionFunction($closure);
            $parameters = $reflection->getParameters();
            $has_self = isset($parameters[0]) and $parameters[0]->getName() === "self";

            $closure_args = [ ...($has_self ? [$obj] : []), ...$args ];
            return $closure->call($obj, ...$closure_args);
        }
        else{
            throw new \Error("Call to undefined method $class_name::$name()");
        }
    }

}

?>
