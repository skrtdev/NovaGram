<?php

namespace skrtdev\NovaGram\Database;

class PostgreSQLDatabase extends AbstractSQLDatabase
{
    protected static bool $need_reset = true;
    protected static array $create_tables = [
        'CREATE TABLE IF NOT EXISTS {users_table} (
            user_id BIGINT UNIQUE
        )',
        'CREATE TABLE IF NOT EXISTS {conversations_table} (
            chat_id BIGINT NOT NULL,
            name VARCHAR(64) NOT NULL,
            value VARCHAR(4096) NOT NULL,
            is_permanent BOOLEAN DEFAULT TRUE
        )
        '
    ];

    public function __construct(string $host, string $dbname, string $username, string $password = '', string $prefix = 'novagram', bool $create_tables = true)
    {
        $this->prefix = $prefix;
        $parts = explode(':', $host);
        $hostname = $parts[0];
        $port = $parts[1] ?? 5432;
        $this->pdo = $pdo ?? new PDOContainer("pgsql:host=$hostname;port=$port;dbname=$dbname", $username, $password, self::OPTIONS);
        $this->initialize($create_tables);
    }


}