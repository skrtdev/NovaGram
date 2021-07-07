<?php

namespace skrtdev\NovaGram\Database;

class SQLiteDatabase extends AbstractSQLDatabase
{
    protected static bool $need_reset = false;

    protected static array $create_tables = [
        'CREATE TABLE IF NOT EXISTS {users_table} (
            user_id BIGINT(64) UNIQUE
        )',
        'CREATE TABLE IF NOT EXISTS {conversations_table} (
            chat_id BIGINT(64) NOT NULL,
            name VARCHAR(64) NOT NULL,
            value BLOB(4096) NOT NULL,
            is_permanent BOOL DEFAULT TRUE
        )'
    ];

    public function __construct(string $filename, string $prefix = 'novagram', bool $create_tables = true)
    {
        $this->prefix = $prefix;
        $this->pdo = new PDOContainer("sqlite:$filename", null, null, self::OPTIONS);
        $this->initialize($create_tables);
    }

    protected function createTables(): void
    {
        parent::createTables();
        parent::refactorDatabase();
    }
}