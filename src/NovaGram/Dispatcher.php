<?php

namespace skrtdev\NovaGram;

use skrtdev\Telegram\Update;
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
    private array $closure_handlers = [];
    private array $class_handlers = [];
    private array $error_handlers = [];

    public function __construct(Bot $Bot, bool $async = true)
    {
        $this->Bot = $Bot;
        $this->async = $async;
        // TODO MOVE POOL TO DISPATCHER
        // TODO ERROR HANDLERS IN CLASSES
    }

    public function handleUpdate(Update $update): void
    {
        if(!empty($this->closure_handlers) && $this->async) $this->Bot->getPool()->resolveQueue();
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
                    $this->Bot->getPool()->parallel($real_handler);
                }
                else{
                    $real_handler();
                }
            }
        }

        #Loop::run(function () use ($handler, $update) {
            // code...
            foreach ($this->class_handlers as $handler) {
                $real_handler = function () use ($handler, $update) {
                    try{
                        $handler->handleSync($this->Bot, $update);
                    }
                    catch(Throwable $e){
                        $this->handleError($e); // TODO MOVE ERRORS IN DISPATCHER
                    }
                };
                if($this->async){
                    #Loop::defer($real_handler);
                    Loop::defer(function () use ($handler, $update) { // TODO ERROR HANDLER
                        \Amp\asyncCall([$handler, "handle"], $this->Bot, $update);
                        #\Amp\coroutine([$handler, "handle"], $this->Bot, $update)();
                    });
                }
                else{
                    $real_handler();
                }
            }

            if($this->async){
                #Loop::run();
            }
        #});
        #$this->onUpdate($update);
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
                print(PHP_EOL.$e.PHP_EOL.PHP_EOL);
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

    public function addClassHandler(BaseHandler $handler): void
    {
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
}


?>
