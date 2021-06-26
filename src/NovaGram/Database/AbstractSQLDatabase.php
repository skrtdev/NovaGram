<?php

namespace skrtdev\NovaGram\Database;

use PDO, PDOStatement;
use skrtdev\Prototypes\Prototypeable;
use skrtdev\Telegram\User;

abstract class AbstractSQLDatabase implements DatabaseInterface
{
    use Prototypeable;

    const OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    const driver_options = [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY];

    protected PDOContainer $pdo;
    protected string $prefix;
    protected string $create_tables;
    protected array $table_names;
    protected bool $need_reset;

    /**
     * @var string[]
     */
    protected array $queries = [
        'selectUser' => 'SELECT * FROM {users_table} WHERE user_id = :user_id',
        'insertUser' => 'INSERT INTO {users_table}(user_id) VALUES (:user_id)',
        'deleteConversation' => 'DELETE FROM {conversations_table} WHERE chat_id = :chat_id AND name = :name',
        'setConversation' => 'INSERT INTO {conversations_table}(chat_id, name, value, additional_param) VALUES (:chat_id, :name, :value, :additional_param)',
        'getConversation' => 'SELECT * FROM {conversations_table} WHERE chat_id = :chat_id AND name = :name',
        'existsConversation' => 'SELECT chat_id FROM {conversations_table} WHERE chat_id = :chat_id AND name = :name',
        'updateConversation' => "UPDATE {conversations_table} SET value = :value, additional_param = :additional_param WHERE chat_id = :chat_id AND name = :name",
        'getConversationsByChat' => 'SELECT * FROM {conversations_table} WHERE chat_id = :chat_id',
        'getConversationsByValue' => 'SELECT * FROM {conversations_table} WHERE value = :value',
    ];


    protected function initialize(){
        $this->prefix = !empty($this->prefix) ? $this->prefix.'_' : '';
        $this->initializeTableNames();
        $this->initializeQueries();
        $this->initializeDatabase();
    }

    protected function initializeTableNames(): void
    {
        $this->table_names = [];
        foreach (['users', 'conversations'] as $value) {
            $this->table_names[$value] = $this->prefix . $value;
        }
    }

    protected function initializeQueries(): void
    {
        $this->queries['createTables'] = $this->create_tables;
        foreach ($this->queries as &$query) {
            $query = str_replace(['{users_table}', '{conversations_table}'], [$this->table_names['users'], $this->table_names['conversations']], $query);
        }
    }

    protected function initializeDatabase(): void
    {
        $this->getPDO()->query($this->queries['createTables']);
    }

    public function deleteConversation(int $chat_id, string $name): void{
        $this->query($this->queries['deleteConversation'], [
            ':chat_id' => $chat_id,
            ':name' => $name,
        ]);
    }

    public function setConversation(int $chat_id, string $name, $value, array $additional_param = []): void{
        $this->query($this->existsConversation($chat_id, $name) ? $this->queries['updateConversation'] : $this->queries['setConversation'], [
            ':chat_id' => $chat_id,
            ':name' => $name,
            ':value' => serialize($value),
            ':additional_param' => serialize($additional_param),
        ]);
    }

    public function existsConversation(int $chat_id, string $name): bool{
        return $this->existQuery($this->queries['existsConversation'], [
            ':chat_id' => $chat_id,
            ':name' => $name,
        ]);
    }

    public function getConversation(int $chat_id, string $name)
    {
        $row = $this->query($this->queries['getConversation'], [
            ':chat_id' => $chat_id,
            ':name' => $name,
        ])->fetch();

        if($row === false) return null;

        $row = $this->normalizeConversation($row);


        return $row['value'];
    }

    public function getConversationsByChat(int $chat_id): array
    {
        $rows = $this->query($this->queries['getConversationsByChat'], [
            ':chat_id' => $chat_id
        ])->fetchAll();

        $result = [];
        foreach ($rows as $row) {
            $row = $this->normalizeConversation($row);

            $value = $row['value'];
            $name = $row['name'];
            $result[$name] = $value;
        }
        return $result;
    }

    public function getConversationsByName(string $name){
        $rows = $this->query($this->queries['getConversationsByName'], [
            ':name' => $name,
        ])->fetchAll();

        $result = [];
        foreach ($rows as &$row) {
            $row = $this->normalizeConversation($row);

            $value = $row['value'];
            $chat_id = $row['chat_id'];
            $result[$chat_id] = $value;
        }
        return $result;
    }

    public function getConversationsByValue($value){
        $rows = $this->query($this->queries['getConversationsByValue'], [
            ':value' => serialize($value),
        ])->fetchAll();

        $result = [];
        foreach ($rows as &$row) {
            $row = $this->normalizeConversation($row);

            $value = $row['value'];
            $name = $row['name'];
            $result[$name] = $value;
        }
        return $result;
    }


    public function insertUser(User $user): void {
        if(!$this->existQuery($this->queries['selectUser'], [':user_id' => $user->id])){
            $this->query($this->queries['insertUser'], [
                ':user_id' => $user->id,
            ]);
        }
    }

    /**
     * @param string $query
     * @param array $params
     * @return false|PDOStatement
     */
    public function query(string $query, array $params = [])
    {
        $statement = $this->getPDO()->prepare($query, self::driver_options);
        $statement->execute($params);
        return $statement;
    }
    public function existQuery(string $query, array $params = []): bool{
        $sth = $this->query($query, $params);
        return !is_bool($sth->fetch());
    }

    public function getPDO(): PDO
    {
        return $this->pdo->getPDO();
    }

    public function resetPDO()
    {
        if($this->need_reset){
            $this->pdo->reset();
        }
    }

    public function normalizeConversation(array $conversation)
    {
        $chat_id = $conversation['chat_id'];
        $name = $conversation['name'];
        $value =& $conversation['value'];

        @$unserialized_value = unserialize($value);
        $value = ($unserialized_value !== false || $value === 'b:0;') ? $unserialized_value : $value;

        $additional_param = unserialize($conversation['additional_param']);
        $is_permanent = $additional_param['is_permanent'] ?? true ;

        if(!$is_permanent){
            $this->deleteConversation($chat_id, $name);
        }

        return $conversation;
    }
}
