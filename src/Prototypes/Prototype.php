<?php

namespace skrtdev\Prototypes;

use Closure, ReflectionFunction, Error;

class Prototype{

    public static array $methods = [];

    public static function addMethod(string $class_name, string $name, Closure $fun): void
    {
        self::$methods[$class_name] ??= [];
        self::$methods[$class_name][$name] = $fun;
    }

    public static function call(object $obj, string $name, array $args)
    {
        $class_name = get_class($obj);
        self::$methods[$class_name] ??= [];
        if(isset(self::$methods[$class_name][$name])){
            $closure = self::$methods[$class_name][$name];
            // DEPRECATE SELF IN v2.0
            $reflection = new ReflectionFunction($closure);
            $parameters = $reflection->getParameters();
            $has_self = isset($parameters[0]) && $parameters[0]->getName() === "self";

            $closure_args = [ ...($has_self ? [$obj] : []), ...$args ];
            return $closure->call($obj, ...$closure_args);
            // v2:
            // return $closure->call($obj, ...$args);
        }
        else{
            throw new Error("Call to undefined method $class_name::$name()");
        }
    }

}

?>
