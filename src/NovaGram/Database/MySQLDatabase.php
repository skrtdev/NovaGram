<?php

namespace skrtdev\NovaGram\Database;

use PDOException, PDOStatement;

class MySQLDatabase extends AbstractSQLDatabase
{
    protected static bool $need_reset = true;

    protected static string $create_tables = '
        CREATE TABLE IF NOT EXISTS {users_table} (
            user_id BIGINT(64) UNIQUE
        );
        CREATE TABLE IF NOT EXISTS {conversations_table} (
            chat_id BIGINT(64) NOT NULL,
            name VARCHAR(64) NOT NULL,
            value BLOB(4096) NOT NULL,
            is_permanent BOOLEAN DEFAULT TRUE
        )
        ';

    public function __construct(string $host, string $dbname, string $username, string $password = '', string $prefix = 'novagram', bool $create_tables = true)
    {
        $this->prefix = $prefix;
        $this->pdo = $pdo ?? new PDOContainer("mysql:host=$host;dbname=$dbname", $username, $password, self::OPTIONS);
        $this->initialize($create_tables);
    }

    public function query(string $query, array $params = []): PDOStatement
    {
        try{
            return parent::query($query, $params);
        }
        catch (PDOException $e) {
            if($e->getMessage() === 'SQLSTATE[HY000]: General error: 2006 MySQL server has gone away') {
                $this->reset();
                return $this->query($query, $params);
            }
            else{
                throw $e;
            }
        }
    }

    protected function createTables(): void
    {
        parent::createTables();
        parent::refactorDatabase();
    }


}