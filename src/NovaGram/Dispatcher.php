<?php

namespace skrtdev\NovaGram;

use skrtdev\Telegram\Update;
use skrtdev\async\Pool;
use Amp\Loop;
use Closure;
use Throwable;
use ReflectionFunction;


/**
 * Allow to handle different updates
 */
class Dispatcher {

    private Bot $Bot;
    private bool $async;
    private bool $group_handlers;
    private Pool $pool;
    private array $closure_handlers = [];
    private array $class_handlers = [];
    private array $error_handlers = [];

    public function __construct(Bot $Bot, bool $async = true, bool $group_handlers = true)
    {
        $this->Bot = $Bot;
        if($async){
            $async = extension_loaded("pcntl");
        }
        $this->async = $async;
        if($async){
            $this->pool = new Pool();
        }
        $this->group_handlers = $group_handlers;
        // TODO ERROR HANDLERS IN CLASSES
    }

    public function handleUpdate(Update $update): void
    {
        $this->resolveQueue();
        $final_handlers = [];
        foreach ($this->closure_handlers as $parameter => $handlers) {
            if($parameter === "update"){
                $handler_update = $update;
            }
            elseif(isset($update->$parameter)){
                $handler_update = $update->$parameter;
            }
            else{
                continue;
            }
            foreach ($handlers as $handler) {
                $real_handler = function () use ($handler, $handler_update) {
                    try{
                        $handler($handler_update);
                    }
                    catch(Throwable $e){
                        $this->handleError($e);
                    }
                };
                if($this->async){
                    if($this->group_handlers){
                        $final_handlers[] = $real_handler;
                    }
                    else{
                        $this->pool->parallel($real_handler);
                    }
                }
                else{
                    $real_handler();
                }
            }
        }

        foreach ($this->class_handlers as $handler) {
            $real_handler = fn() => Closure::fromCallable([$handler, "handle"])($update); // TODO ERROR HANDLING
            if($this->async){
                if($this->group_handlers){
                    $final_handlers[] = $real_handler;
                }
                else{
                    $this->pool->parallel($real_handler);
                }
            }
            else{
                try{
                    $real_handler();
                }
                catch(Throwable $e){
                    $this->handleError($e);
                }
            }
        }

        if(!empty($final_handlers)){
            $this->pool->parallel(function () use ($final_handlers) {
                foreach ($final_handlers as $handler) {
                    $handler();
                }
            });
        }
    }

    protected function handleError(Throwable $e): void
    {
        $handled = false;
        foreach ($this->error_handlers as $handler) {
            if(self::isAllowedThrowableType($e, $handler)){
                $handled = true;
                $handler($e);
            }
        }
        if(!$handled){
            if(Utils::isCLI()){
                print(PHP_EOL.'An exception has not been handled: '.PHP_EOL.$e.PHP_EOL.PHP_EOL);
            }
            else{
                throw $e;
            }
        }

    }

    protected static function isAllowedThrowableType(Throwable $throwable, callable $callable): bool
    {
        $reflection = new ReflectionFunction($callable);

        $parameters = $reflection->getParameters();

        if (!isset($parameters[0])) {
            return false;
        }

        $firstParameter = $parameters[0];

        if (!$firstParameter) {
            return true;
        }

        $type = $firstParameter->getType();

        if (!$type) {
            return true;
        }

        if (is_a($throwable, $type->getName())) {
            return true;
        }

        return false;
    }

    public function addClosureHandler(Closure $handler, string $parameter = "update"): void
    {
        $this->closure_handlers[$parameter] ??= [];
        $this->closure_handlers[$parameter][] = $handler;
    }

    // BaseHandler|string
    public function addClassHandler($handler): void
    {
        if(is_string($handler)){
            $handler = new $handler($this->Bot);
        }
        $this->class_handlers[] = $handler;
    }

    public function addErrorHandler(Closure $handler): void
    {
        $this->error_handlers[] = $handler;
    }

    public function hasHandlers(): bool
    {
        return !empty($this->closure_handlers) || !empty($this->class_handlers);
    }

    public function hasErrorHandlers(): bool
    {
        return !empty($this->error_handlers);
    }

    public static function paramaterToHandler(string $string): string
    {
        $str = str_replace('_', '', ucwords($string, '_'));
        return "on".$str;
    }

    public function getAllowedUpdates(): array
    {
        if(!empty($this->class_handlers)) return [];
        if(isset($this->closure_handlers['update'])){
            // there is a general update handler, should retrieve all kind of updates
            return [];
        }
        else return array_keys($this->closure_handlers);
    }

    public function resolveQueue(): void
    {
        if(!empty($this->closure_handlers) && $this->async) $this->pool->resolveQueue();
    }

    public function getPool(): Pool{
        return $this->pool;
    }
}


?>
