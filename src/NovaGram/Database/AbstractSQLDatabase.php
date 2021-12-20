<?php

namespace skrtdev\NovaGram\Database;

use PDO, PDOStatement, PDOException;
use skrtdev\NovaGram\{Bot, Exception, Utils};
use skrtdev\Prototypes\Prototypeable;
use skrtdev\Telegram\{Message, User};

abstract class AbstractSQLDatabase implements DatabaseInterface
{
    use Prototypeable;

    const OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    const driver_options = [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY];

    protected static bool $need_reset;
    protected PDOContainer $pdo;
    protected string $prefix;
    protected array $table_names;
    /**
     * @var bool[]
     */
    protected array $cached_conversations = [];
    /**
     * @var bool[]
     */
    protected array $cached_users = [];

    /**
     * @var string[]
     */
    protected array $queries = [
        'selectUser' => 'SELECT * FROM {users_table} WHERE user_id = :user_id',
        'insertUser' => 'INSERT INTO {users_table}(user_id) VALUES (:user_id)',
        'deleteConversation' => 'DELETE FROM {conversations_table} WHERE chat_id = :chat_id AND name = :name',
        'deleteChatConversations' => 'DELETE FROM {conversations_table} WHERE chat_id = :chat_id',
        'setConversation' => 'INSERT INTO {conversations_table}(chat_id, name, value, is_permanent) VALUES (:chat_id, :name, :value, :is_permanent)',
        'getConversation' => 'SELECT * FROM {conversations_table} WHERE chat_id = :chat_id AND name = :name',
        'existsConversation' => 'SELECT chat_id FROM {conversations_table} WHERE chat_id = :chat_id AND name = :name',
        'updateConversation' => "UPDATE {conversations_table} SET value = :value, is_permanent = :is_permanent WHERE chat_id = :chat_id AND name = :name",
        'getChatConversations' => 'SELECT * FROM {conversations_table} WHERE chat_id = :chat_id',
        'getConversationsByValue' => 'SELECT * FROM {conversations_table} WHERE value = :value',
        'getConversationsByName' => 'SELECT * FROM {conversations_table} WHERE name = :name',
    ];
    protected bool $tables_created = false;


    protected function initialize(bool $create_tables = true){
        $this->prefix = !empty($this->prefix) ? $this->prefix.'_' : '';
        $this->initializeTableNames();
        $this->initializeQueries();
        if($create_tables && Utils::isCLI()) $this->createTables();
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
        $this->queries = str_replace(['{users_table}', '{conversations_table}'], [$this->table_names['users'], $this->table_names['conversations']], $this->queries);
        $this->queries['createTables'] = static::$create_tables;
        $this->queries['createTables'] = str_replace(['{users_table}', '{conversations_table}'], [$this->table_names['users'], $this->table_names['conversations']], $this->queries['createTables']);
    }

    protected function createTables(): void
    {
        if($this->tables_created) return;
        $this->tables_created = true;
        if(is_string($this->queries['createTables'])){
            $this->query($this->queries['createTables']);
        }
        elseif(is_array($this->queries['createTables'])){
            foreach ($this->queries['createTables'] as $query) {
                $this->query($query);
            }
        }
    }

    public function deleteConversation(int $chat_id, string $name): void
    {
        $this->query($this->queries['deleteConversation'], [
            ':chat_id' => $chat_id,
            ':name' => $name,
        ]);
        $this->cached_conversations[$chat_id.$name] = false;
    }

    public function deleteChatConversations(int $chat_id): void
    {
        $this->query($this->queries['deleteChatConversations'], [
            ':chat_id' => $chat_id,
        ]);
        $this->cached_conversations = [];
    }

    public function setConversation(int $chat_id, string $name, $value, array $params = []): void
    {
        $this->query($this->existsConversation($chat_id, $name) ? $this->queries['updateConversation'] : $this->queries['setConversation'], [
            ':chat_id' => $chat_id,
            ':name' => $name,
            ':value' => serialize($value),
            ':is_permanent' => ($params['is_permanent'] ?? true) ?: 0,
        ]);
        $this->cached_conversations[$chat_id.$name] = true;
    }

    public function existsConversation(int $chat_id, string $name): bool
    {
        return $this->cached_conversations[$chat_id.$name] ??= $this->existQuery($this->queries['existsConversation'], [
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

    public function getChatConversations(int $chat_id): array
    {
        $rows = $this->query($this->queries['getChatConversations'], [
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

    public function getConversationsByName(string $name): array
    {
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

    public function getConversationsByValue($value): array
    {
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

    public function existUser(int $user_id): bool
    {
        return $this->cached_users[$user_id] ??= $this->existQuery($this->queries['selectUser'], [':user_id' => $user_id]);
    }

    public function saveUser(User $user): void
    {
        $this->query($this->queries['insertUser'], [
            ':user_id' => $user->id,
        ]);
    }

    public function insertUser(User $user): void
    {
        if(!$this->existUser($user->id)){
            $this->saveUser($user);
            if(count($this->cached_users) > 100000){
                $this->cached_users = [];
            }
            $this->cached_users[$user->id] = true;
        }
    }

    /**
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function query(string $query, array $params = []): PDOStatement
    {
        if(!$this->tables_created) $this->createTables();
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

    public function reset(): void
    {
        if(static::$need_reset){
            $this->pdo->reset();
        }
    }

    public function normalizeConversation(array $conversation): array
    {
        $chat_id = $conversation['chat_id'];
        $name = $conversation['name'];
        $value =& $conversation['value'];

        @$unserialized_value = unserialize($value);
        $value = ($unserialized_value !== false || $value === 'b:0;') ? $unserialized_value : $value;

        $is_permanent = $conversation['is_permanent'] ?? true;
        if(!$is_permanent){
            $this->deleteConversation($chat_id, $name);
        }

        return $conversation;
    }

    public function bind(Bot $Bot): void
    {
        $Bot->onMessage(function(Message $message) {
            $this->insertUser($message->from);
        }, null, fn(Message $message) => $message->chat->type === 'private' && isset($message->from), 9**8);
    }

    /**
     * @throws Exception
     */
    protected function refactorDatabase(): void
    {
        try {
            $table = $this->table_names['conversations'];
            $rows = $this->query("SELECT chat_id, name, additional_param FROM $table WHERE 1")->fetchAll();
            if(!Utils::isCLI()){
                throw new Exception('Database need to be refactored, please start bot script from command line');
            }
            $this->query("ALTER TABLE $table ADD is_permanent BOOLEAN DEFAULT TRUE");
            echo 'Refactoring database, please wait. It could take up to some minutes...', PHP_EOL;
            $total_count = count($rows);
            $i = 1;
            $started = hrtime(true);
            $prepared = $this->getPDO()->prepare("UPDATE $table SET is_permanent = :is_permanent WHERE chat_id = :chat_id AND name = :name");
            foreach ($rows as ['chat_id' => $chat_id, 'name' => $name, 'additional_param' => $additional_param]) {
                $additional_param = unserialize($additional_param);
                $is_permanent = $additional_param['is_permanent'] ?? true;
                $prepared->execute([
                    ':is_permanent' => (int) $is_permanent,
                    ':chat_id' => $chat_id,
                    ':name' => $name
                ]);
                if($i % 100 === 0){
                    $elapsed = (hrtime(true) - $started) / 10**9;
                    echo round($i / $total_count * 100, 2), '% - ETA: ', round($elapsed / $i * ($total_count - $i)), ' seconds', PHP_EOL;
                }
                $i++;
            }
            $this->query("ALTER TABLE $table DROP COLUMN additional_param");
            echo 'Database refactored.', PHP_EOL;
            exit();
        }
        catch (PDOException $e){
            return;
        }
    }
}
