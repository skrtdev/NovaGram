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

    public function __construct(Bot $Bot, bool $async = true, bool $group_handlers = true, bool $wait_handlers = false, ?int $max_childs = null)
    {
        $this->Bot = $Bot;
        if($async){
            $async = extension_loaded("pcntl");
        }
        $this->async = $async;
        if($async){
            $this->pool = new Pool($max_childs, !$wait_handlers);
        }
        $this->group_handlers = $group_handlers;
    }

    public function handleUpdate(Update $update): void
    {
        $this->resolveQueue();
        if($this->async){
            if($this->Bot->hasDatabase()){
                $this->Bot->getDatabase()->resetPDO();
            }
            $process_name = "NovaGram: child process ({$this->Bot->getUsername()}:{$update->update_id})";
        }
        
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
                        $this->pool->parallel($real_handler, $process_name);
                    }
                }
                else{
                    $real_handler();
                }
            }
        }

        foreach ($this->class_handlers as $handler) {
            $real_handler = function () use ($handler, $update) {
                try{
                    Closure::fromCallable([$handler, "handle"])($update);
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
                    $this->pool->parallel($real_handler, $process_name);
                }
            }
            else{
                $real_handler();
            }
        }

        if(!empty($final_handlers)){
            $this->pool->parallel(function () use ($final_handlers, $update) {
                $this->Bot->logger->debug("Update handling started.", ['update_id' => $update->update_id]);
                $started = hrtime(true)/10**9;
                foreach ($final_handlers as $handler) {
                    $handler();
                }
                $this->Bot->logger->debug("Update handling finished.", ['update_id' => $update->update_id, 'took' => (((hrtime(true)/10**9)-$started)*1000).'ms']);
            }, $process_name);
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

    // string|array
    public function addClassHandler($handlers): void
    {
        if(is_string($handlers)){
            $handlers = [$handlers];
        }
        foreach ($handlers as $handler) {
            if(is_a($handler, BaseHandler::class, true)){
                $this->class_handlers[] = new $handler($this->Bot);
            }
            else{
                throw new Exception("Invalid class handler provided: $handler");
            }
        }
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

    public static function parameterToHandler(string $string): string
    {
        return "on".str_replace('_', '', ucwords($string, '_'));
    }

    public static function handlerToParameter(string $string): string
    {
        $string = substr($string, 2);
        $string[0] = strtolower($string[0]);
        $string = preg_replace('/([A-Z])/', '_${1}', $string);
        $string = strtolower($string);
        return $string;
    }

    public static function getUpdateType(Update $update): string
    {
        $properties = get_object_vars($update);
        foreach ($properties as $key => $value) {
            if($key !== "update_id" && isset($value)){
                return $key;
            }
        }
    }

    public function getAllowedUpdates(): array
    {
        $params = [];
        if(!empty($this->class_handlers)){
            foreach ($this->class_handlers as $class_handler) {
                foreach ($class_handler->getHandlers() as $value) {
                    $value = self::handlerToParameter($value);
                    if($value === "update"){
                        // there is a general update handler, should retrieve all kind of updates
                        return [];
                    }
                    $params[] = $value;
                }
            }
        }
        if(isset($this->closure_handlers['update'])){
            // there is a general update handler, should retrieve all kind of updates
            return [];
        }
        else return array_values(array_unique(array_merge($params, array_keys($this->closure_handlers))));
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
