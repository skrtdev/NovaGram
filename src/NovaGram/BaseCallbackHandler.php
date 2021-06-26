<?php

namespace skrtdev\NovaGram;

use skrtdev\Telegram\CallbackQuery;

use Closure;

/**
 * Base Callback Handler for handling callback queries
 */
abstract class BaseCallbackHandler {

    protected Bot $Bot;
    public static bool $fired = false;

    protected string $pattern;

    final public function __construct(Bot $Bot)
    {
        if(!static::$fired){
            $this->Bot = $Bot;
            $Bot->onCallbackData($this->pattern, Closure::fromCallable([$this, "handle"]));
            static::$fired = true;
        }
        else{
            throw new Exception(static::class." handler has already been instantiated");

        }
    }

    abstract public function handle(CallbackQuery $callback_query);


}

