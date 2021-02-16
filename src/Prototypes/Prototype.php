<?php

namespace skrtdev\Prototypes;

use Closure, ReflectionFunction, Error;

class Prototype{

    protected static array $methods = [];
    protected static array $classes = [];

    public static function isPrototypeable(string $class_name): bool
    {
        // method_exists is a bc, in v2 all classes should implement Prototypeable
        return self::$classes[$class_name] ??= method_exists($class_name, 'addMethod') && method_exists($class_name, '__call');
    }

    public static function addMethod(string $class_name, string $name, Closure $fun): void
    {
        if(self::isPrototypeable($class_name)){
            if(!method_exists($class_name, $name)){
                self::$methods[$class_name] ??= [];
                if(!isset(self::$methods[$class_name][$name])){
                    self::$methods[$class_name][$name] = $fun;
                }
                else{
                    throw new Exception("Invalid method name provided for class '$class_name': method '$name' is already a Prototype");
                }
            }
            else{
                throw new Exception("Invalid method name provided for class '$class_name': method '$name' already exists");
            }
        }
        else{
            throw new Exception("Invalid class provided: class '$class_name' it's not Prototypeable");
        }
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
