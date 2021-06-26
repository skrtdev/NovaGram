<?php

namespace skrtdev\NovaGram\Database;


class PostgreSQLDatabase extends AbstractSQLDatabase
{
    protected bool $need_reset = true;
    protected string $create_tables = '';

    public function __construct(string $host, string $dbname, string $username, string $password, string $prefix = 'novagram')
    {
        $this->prefix = $prefix;
        $this->pdo = $pdo ?? new PDOContainer("pgsql:host=$host;dbname=$dbname", $username, $password, self::OPTIONS);
        $this->initialize();
    }

    protected function initializeDatabase(): void
    {
        $this->getPDO()->query("CREATE TABLE IF NOT EXISTS {$this->table_names['users']} (
            user_id BIGINT UNIQUE
        )");
        $this->getPDO()->query("CREATE TABLE IF NOT EXISTS {$this->table_names['conversations']} (
            chat_id BIGINT NOT NULL,
            name VARCHAR(64) NOT NULL,
            value VARCHAR(4096) NOT NULL,
            additional_param VARCHAR(256) NOT NULL
        )
        ");
    }


}