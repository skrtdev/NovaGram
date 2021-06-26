<?php

namespace skrtdev\NovaGram\Database;

use PDO;
use skrtdev\NovaGram\Exception;

class PDOContainer {

    private string $dsn;
    private ?string $username;
    private ?string $password;
    private ?array $options;
    private ?PDO $instance;

    /**
     * @throws Exception
     */
    public function __construct(string $dsn, string $username = null, string $password = null, array $options = null)
    {
        if(!extension_loaded('pdo')){
            throw new Exception('PDO Exception is missing');
        }
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
        $this->options = $options;
    }

    public function getPDO(): PDO
    {
        return $this->instance ??= new PDO($this->dsn, $this->username, $this->password, $this->options);
    }

    public function reset(): void
    {
        $this->instance = null;
    }

    public function __serialize()
    {
        $obj = get_object_vars($this);
        unset($obj['instance']);
        return $obj;
    }
}

