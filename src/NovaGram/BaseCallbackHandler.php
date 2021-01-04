<?php

namespace skrtdev\NovaGram;

use skrtdev\Telegram\CallbackQuery;

use Closure;

/**
 * Base Callback Handler for handling callback queries
 */
abstract class BaseCallbackHandler {

    protected Bot $Bot;
    public static array $fired = [];

    protected string $pattern;

    final public function __construct(Bot $Bot)
    {
        if(!(self::$fired[static::class] ?? false)){
            $this->Bot = $Bot;
            $Bot->onCallbackData($this->pattern, Closure::fromCallable([$this, "handle"]));
            self::$fired[static::class] = true;
        }
        else{
            throw new Exception(static::class." handler has already been instantiated");

        }
    }

    abstract public function handle(CallbackQuery $callback_query);


}


?>
