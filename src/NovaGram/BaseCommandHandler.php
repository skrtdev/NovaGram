<?php

namespace skrtdev\NovaGram;

use skrtdev\Telegram\Message;

use Closure;

/**
 * Base Command Handler for handling commands
 */
abstract class BaseCommandHandler {

    protected Bot $Bot;
    public /*protected*/ static array $fired = [];

    /* @var string|array */
    protected /* string|array */ $commands;
    protected string $description;

    final public function __construct(Bot $Bot)
    {
        if(!(self::$fired[static::class] ?? false)){
            $this->Bot = $Bot;
            $Bot->onCommand($this->commands, Closure::fromCallable([$this, "handle"]), $this->description);
            self::$fired[static::class] = true;
        }
        else{
            throw new Exception(static::class." handler has already been instantiated");

        }
    }

    abstract public function handle(Message $message);


}


?>
