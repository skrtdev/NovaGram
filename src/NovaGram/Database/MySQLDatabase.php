<?php

namespace skrtdev\NovaGram\Database;

use PDOException;

class MySQLDatabase extends AbstractSQLDatabase
{
    protected bool $need_reset = true;

    protected string $create_tables = '
        CREATE TABLE IF NOT EXISTS {users_table} (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            user_id BIGINT(64) UNIQUE
        );
        CREATE TABLE IF NOT EXISTS {conversations_table} (
            chat_id BIGINT(64) NOT NULL,
            name VARCHAR(64) NOT NULL,
            value BLOB(4096) NOT NULL,
            additional_param VARCHAR(256) NOT NULL
        )
        ';

    public function __construct(string $host, string $dbname, string $username, string $password, string $prefix = 'novagram')
    {
        $this->prefix = $prefix;
        $this->pdo = $pdo ?? new PDOContainer("mysql:host=$host;dbname=$dbname", $username, $password, self::OPTIONS);
        $this->initialize();
    }

    public function query(string $query, array $params = [])
    {
        try{
            return parent::query($query, $params);
        }
        catch (PDOException $e) {
            if($e->getMessage() === 'SQLSTATE[HY000]: General error: 2006 MySQL server has gone away') {
                $this->resetPDO();
                return $this->query($query, $params);
            }
            else{
                throw $e;
            }
        }
    }


}