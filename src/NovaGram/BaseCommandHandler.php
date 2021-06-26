<?php

namespace skrtdev\NovaGram;

use skrtdev\Telegram\Message;

use Closure;

/**
 * Base Command Handler for handling commands
 */
abstract class BaseCommandHandler {

    protected Bot $Bot;
    protected static bool $fired = false;

    /* @var string|array */
    protected /* string|array */ $commands;
    protected string $description;

    final public function __construct(Bot $Bot)
    {
        if(!static::$fired){
            $this->Bot = $Bot;
            $Bot->onCommand($this->commands, Closure::fromCallable([$this, "handle"]), $this->description ?? null);
            static::$fired = true;
        }
        else{
            throw new Exception(static::class." handler has already been instantiated");

        }
    }

    abstract public function handle(Message $message);


}

