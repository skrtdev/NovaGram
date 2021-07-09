<?php

namespace skrtdev\NovaGram;

use skrtdev\Telegram\Message;

use Closure;

/**
 * Base Command Handler for handling commands
 */
abstract class BaseCommandHandler {

    protected Bot $Bot;

    /* @var string|array */
    protected /* string|array */ $commands;
    protected ?CommandScope $scope = null;
    protected string $description;

    final public function __construct(Bot $Bot)
    {
        $this->Bot = $Bot;
        $Bot->onCommand($this->commands, Closure::fromCallable([$this, "handle"]), $this->scope, $this->description ?? null);
    }

    abstract public function handle(Message $message);


}

