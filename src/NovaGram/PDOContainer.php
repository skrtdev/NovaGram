<?php

namespace skrtdev\NovaGram;

use PDO;

class PDOContainer {

    private array $args;
    private PDO $instance;

    public function __construct(...$args)
    {
        $this->args = $args;
    }

    public function getPDO(): PDO
    {
        return $this->instance ??= new PDO(...$this->args);
    }

    public function reset(): void
    {
        unset($this->instance);
    }

    public function __serialize()
    {
        $obj = get_object_vars($this);
        unset($obj['instance']);
        return $obj;
    }
}


?>
