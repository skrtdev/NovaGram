<?php

namespace skrtdev\NovaGram\Database;

class SQLiteDatabase extends AbstractSQLDatabase
{
    protected bool $need_reset = false;

    protected string $create_tables = '
        CREATE TABLE IF NOT EXISTS {users_table} (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id BIGINT(64) UNIQUE
        );
        CREATE TABLE IF NOT EXISTS {conversations_table} (
            chat_id BIGINT(64) NOT NULL,
            name VARCHAR(64) NOT NULL,
            value BLOB(4096) NOT NULL,
            additional_param VARCHAR(256) NOT NULL
        )
        ';

    public function __construct(string $filename, string $prefix = 'novagram')
    {
        $this->prefix = $prefix;
        $this->pdo = new PDOContainer("sqlite:$filename", null, null, self::OPTIONS);
        $this->initialize();
    }
}