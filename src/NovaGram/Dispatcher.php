<?php

namespace skrtdev\NovaGram;

use ReflectionUnionType;
use skrtdev\Telegram\Update;
use skrtdev\async\Pool;
use Closure;
use Throwable;
use ReflectionFunction;


/**
 * Allow to handle different updates
 */
class Dispatcher {

    const ALL_UPDATES = ['message', 'edited_message', 'channel_post', 'edited_channel_post', 'inline_query', 'chosen_inline_result', 'callback_query', 'shipping_query', 'pre_checkout_query', 'poll', 'poll_answer', 'my_chat_member', 'chat_member', 'chat_join_request'];

    private Bot $Bot;
    private bool $async;
    private bool $group_handlers;
    private static bool $stop_update_handling = false;
    private Pool $pool;
    /**
     * @var Handler[][]
     */
    private array $handlers = [];
    private array $class_handlers = [];
    private array $error_handlers = [];

    public function __construct(Bot $Bot, bool $async = true, bool $group_handlers = true, bool $wait_handlers = false, ?int $max_children = null)
    {
        $this->Bot = $Bot;
        if($this->async = $async){
            $this->pool = new Pool($max_children, !$wait_handlers);
        }
        $this->group_handlers = $group_handlers;
    }

    public function initialize(): void
    {
        $real_handlers = [];
        foreach ($this->handlers as $parameter => $handlers_list) {
            $real_handlers[$parameter] = [];
            ksort($handlers_list);
            foreach ($handlers_list as $handlers) {
                foreach ($handlers as $handler) {
                    $real_handlers[$parameter][] = $handler;
                }
            }
        }
        $this->handlers = $real_handlers;
    }

    public function handleUpdate(Update $update, bool $force_sync = false): void
    {
        $this->resolveQueue();
        if($this->async && !$force_sync){
            if($this->Bot->hasDatabase()){
                $this->Bot->getDatabase()->reset();
            }
        }

        $final_handlers = [];
        foreach ($this->handlers as $parameter => $handlers) {
            if($parameter === 'update'){
                $handler_update = $update;
            }
            elseif(isset($update->$parameter)){
                $handler_update = $update->$parameter;
            }
            else{
                continue;
            }
            foreach ($handlers as $handler) {
                if(self::$stop_update_handling){
                    break;
                }
                if(!$handler->filter($handler_update)){
                    continue;
                }

                $real_handler = function ($handler, $handler_update) {
                    try{
                        $handler->handle($handler_update);
                    }
                    catch(Throwable $e){
                        $this->handleError($e);
                    }
                };
                if($this->async && !$force_sync){
                    if($this->group_handlers){
                        $final_handlers[] = $parameter === 'update' ? fn() => $handler->handle($handler_update) : [$handler, 'handle'];
                    }
                    else{
                        $this->pool->parallel($real_handler, $handler, $handler_update);
                    }
                }
                else{
                    $real_handler($handler, $handler_update);
                }
            }
        }
        foreach ($this->class_handlers as $handler) {
            if(self::$stop_update_handling){
                break;
            }
            $real_handler = function () use ($handler, $update) {
                try{
                    $handler->handle($update);
                }
                catch(Throwable $e){
                    $this->handleError($e);
                }
            };
            if($this->async && !$force_sync){
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

        $handler_update = $update->{self::getUpdateType($update)};
        if(!empty($final_handlers)){
            $this->pool->parallel(function ($update, $final_handlers) use ($handler_update) {
                @cli_set_process_title("NovaGram: child process ({$this->Bot->getUsername()}:$update->update_id)");
                $this->Bot->logger->debug("Update handling started.", ['update_id' => $update->update_id]);
                $started = hrtime(true)/10**6;
                foreach ($final_handlers as $handler) {
                    try{
                        $handler($handler_update);
                    }
                    catch(Throwable $e){
                        $this->handleError($e);
                    }
                    if(self::$stop_update_handling){
                        break;
                    }
                }
                $this->Bot->logger->debug("Update handling finished.", ['update_id' => $update->update_id, 'took' => (((hrtime(true)/10**6)-$started)).'ms']);
            }, $update, $final_handlers);
        }

        self::$stop_update_handling = false;
    }

    protected function handleError(Throwable $e): void
    {
        $handled = false;
        foreach ($this->error_handlers as $handler) {
            if(self::isAllowedThrowableType($e, $handler)){
                $handled = true;
                try{
                    $handler($e);
                }
                catch(Throwable $e){
                    if(Utils::isCLI()){
                        $this->Bot->logger->critical('An Exception has been thrown inside error handling: '.get_class($e).'. Full exception has been printed to stdout.');
                        echo TracebackNormalizer::getNormalizedExceptionString($e), PHP_EOL;
                    }
                    else{
                        $this->Bot->logger->critical('An Exception has been thrown inside error handling: '.get_class($e));
                        throw $e;
                    }
                }
            }
        }
        if(!$handled){
            if(Utils::isCLI()){
                print('An exception has not been handled: '.PHP_EOL.TracebackNormalizer::getNormalizedExceptionString($e).PHP_EOL);
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

        $type = $parameters[0]->getType();

        if ($type === null) {
            return true;
        }

        $types = $type instanceof ReflectionUnionType ? $type->getTypes() : [$type];

        foreach ($types as $type) {
            if (is_a($throwable, $type->getName())) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param Closure $handler
     * @param string $parameter
     * @param FilterInterface[]|null $filters
     * @param null $main_filter
     * @param int $group
     * @throws Exception
     */
    public function addClosureHandler(Closure $handler, string $parameter = 'update', array $filters = null, $main_filter = null, int $group = 0): void
    {
        $this->handlers[$parameter] ??= [];
        $this->handlers[$parameter][$group] ??= [];
        if(Utils::isPHP8()){
            $filters ??= Utils::getFilters($handler);
            if(empty($filters)){
                $this->handlers[$parameter][$group][] = new Handler($handler, $main_filter);
            }
            else foreach ($filters as $filter) {
                if(!$filter->isAllowedUpdate($parameter)){
                    throw new Exception('Filter '.get_class($filter)." does not allows $parameter updates");
                }
            }
            $this->handlers[$parameter][$group][] = new Handler($handler, Handler::sumFilters($main_filter, Handler::orFilter($filters)));
        }
        else $this->handlers[$parameter][$group][] = new Handler($handler, $main_filter);
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
        return !empty($this->handlers) || !empty($this->class_handlers);
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
        return strtolower($string);
    }

    public static function getUpdateType(Update $update): string
    {
        $properties = get_object_vars($update);
        unset($properties['update_id']);
        foreach ($properties as $key => $value) {
            if(isset($value)) {
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
                    if($value === 'update'){
                        // there is a general update handler, should retrieve all kind of updates
                        return self::ALL_UPDATES;
                    }
                    $params[] = $value;
                }
            }
        }
        if(isset($this->handlers['update'])){
            // there is a general update handler, should retrieve all kind of updates
            return self::ALL_UPDATES;
        }
        else return array_values(array_unique(array_merge($params, array_keys($this->handlers))));
    }

    public static function stopHandling(): void
    {
        self::$stop_update_handling = true;
    }

    public function resolveQueue(): void
    {
        if(!empty($this->handlers) && $this->async) $this->pool->resolveQueue();
    }

    public function getPool(): Pool
    {
        return $this->pool;
    }

    public function __debugInfo(): array
    {
        $vars = get_object_vars($this);
        foreach (['Bot', 'handlers', 'class_handlers', 'error_handlers'] as $key) {
            unset($vars[$key]);
        }
        return $vars;
    }


}

