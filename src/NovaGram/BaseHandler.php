<?php

namespace skrtdev\NovaGram;

use skrtdev\Telegram\Update;

/**
 * Base Handler for handling updates
 */
class BaseHandler {

    protected Bot $Bot;

    final public function __construct(Bot $Bot)
    {
        $this->Bot = $Bot;
    }

    final public function handle(Update $update)
    {
        return $this->onUpdate($this->Bot, $update);
    }

}


?>
