<?php

namespace skrtdev\NovaGram;

use skrtdev\Telegram\Update;

/**
 * Base Handler for handling updates
 */
class BaseHandler {

    final public function __construct()
    {
        // code...
    }

    final public function handle(Bot $Bot, Update $update): \Generator
    {
        yield from $this->onUpdate($Bot, $update);
    }

    final public function handleSync(Bot $Bot, Update $update)
    {
        $this->onUpdate($Bot, $update);
    }

}


?>
