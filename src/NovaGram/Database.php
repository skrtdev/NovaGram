<?php

namespace skrtdev\NovaGram;

use PDO;
use skrtdev\Prototypes\proto;
use skrtdev\Telegram\User;

class Database{

    use proto;

    const driver_options = [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY];

    protected array $settings;

    /**
     * @var PDO|PDOContainer $pdo
     */
    protected /*PDO|PDOContainer*/ $pdo;
    protected string $prefix;

    public function __construct(array $settings, PDO $pdo = null){

        $settings_array = [
            "driver" => "mysql",
            "host" => "localhost:3306",
            "dbpass" => "",
            "prefix" => "novagram"
        ];

        foreach ($settings_array as $name => $default) $settings[$name] ??= $default;

        @[ // fix this
            "driver" => $driver,
            "host" => $host,
            "dbname" => $dbname,
            "dbuser" => $dbuser,
            "dbpass" => $dbpass
        ] = $settings;

        $this->settings = $settings;

        switch ($driver) {
            case 'sqlite':
                $connection = $host;
                break;
            default:
                $connection = "host=$host;dbname=$dbname";
                break;
        } // will turn into a match in php8

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
           # PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->pdo = $pdo ?? new PDOContainer("$driver:$connection", $dbuser, $dbpass, $options);

        $prefix = $settings['prefix'] ?? null;
        $this->prefix = isset($prefix) ? $prefix."_" : "";

        $this->auto_increment = $driver === "sqlite" ? "AUTOINCREMENT" : "AUTO_INCREMENT";
        $this->initializeTableNames();
        $this->initializeQueries();
        $this->initializeDatabase();
        $this->initializeConversations();


    }

    public function initializeTableNames(): void{
        $this->tableNames = [];
        foreach (['users', 'conversations'] as $key => $value) {
            $this->tableNames[$value] = $this->prefix.$value;
        }
    }

    public function initializeQueries(): void{
        $this->queries = [
            "selectUser" => "SELECT * FROM {$this->tableNames['users']} WHERE user_id = :user_id",
            "insertUser" => "INSERT INTO {$this->tableNames['users']}(user_id) VALUES (:user_id)",
            "deleteConversation" => "DELETE FROM {$this->tableNames['conversations']} WHERE chat_id = :chat_id AND name = :name",
            "setConversation" => "INSERT INTO {$this->tableNames['conversations']}(chat_id, name, value, additional_param) VALUES (:chat_id, :name, :value, :additional_param)",
            "getConversation" => "SELECT * FROM {$this->tableNames['conversations']} WHERE chat_id = :chat_id AND name = :name",
            "getConversationsByChat" => "SELECT * FROM {$this->tableNames['conversations']} WHERE chat_id = :chat_id",
            "getConversationsByValue" => "SELECT * FROM {$this->tableNames['conversations']} WHERE value = :value",
        ];
    }

    private function initializeDatabase(): void{
        $this->query("CREATE TABLE IF NOT EXISTS {$this->tableNames['users']} (
            id INTEGER PRIMARY KEY {$this->auto_increment},
            user_id BIGINT(255) UNIQUE
        )");
    }

    public function initializeConversations(): void{
        $this->query("CREATE TABLE IF NOT EXISTS {$this->tableNames['conversations']} (
            id INTEGER PRIMARY KEY {$this->auto_increment},
            chat_id BIGINT(255) NOT NULL,
            name VARCHAR(64) NOT NULL,
            value BLOB(4096) NOT NULL,
            additional_param VARCHAR(256) NOT NULL
        )");
    }

    public function deleteConversation(int $chat_id, string $name): void{
        $this->query($this->queries['deleteConversation'], [
            ':chat_id' => $chat_id,
            ':name' => $name,
        ]);
    }

    public function setConversation(int $chat_id, string $name, $value, array $additional_param = []): void{
        $this->deleteConversation($chat_id, $name);
        $this->query($this->queries['setConversation'], [
            ':chat_id' => $chat_id,
            ':name' => $name,
            ':value' => serialize($value),
            ':additional_param' => serialize($additional_param),
        ]);
    }

    public function getConversation(int $chat_id, string $name){
        $row = $this->query($this->queries['getConversation'], [
            ':chat_id' => $chat_id,
            ':name' => $name,
        ])->fetch();

        if($row === false) return;

        $value = $row['value'];
        @$unserialized_value = unserialize($value);
        $value = $unserialized_value !== false ? $unserialized_value : $value;

        $additional_param = unserialize($row['additional_param']);

        $is_permanent = $additional_param['is_permanent'] ?? true ;

        if(!$is_permanent){
            $this->deleteConversation($chat_id, $name);
        }
        return $value;
    }

    public function getConversationsByChat(int $chat_id){
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

    public function getLastInsertId(): int{
        return $this->getPDO()->query("SELECT LAST_INSERT_ID() as id")->fetch()['id'];
    }

    public function query(string $query, array $params = []){
        $sth = $this->getPDO()->prepare($query, self::driver_options);
        $sth->execute($params);
        return $sth;
    }
    public function existQuery(string $query, array $params = []): bool{
        $sth = $this->query($query, $params);
        return !is_bool($sth->fetch());
    }

    public function getPDO(): PDO{
        return $this->pdo instanceof PDOContainer ? $this->pdo->getPDO() : $this->pdo;
    }

    public function resetPDO()
    {
        if($this->settings['driver'] === "mysql" && $this->pdo instanceof PDOContainer){
            $this->pdo->reset();
        }
    }

    public function normalizeConversation(array $conversation)
    {
        $chat_id = $conversation['chat_id'];
        $name = $conversation['name'];
        $value =& $conversation['value'];

        @$unserialized_value = unserialize($value);
        $value = $unserialized_value !== false ? $unserialized_value : $value;

        $additional_param = unserialize($conversation['additional_param']);
        $is_permanent = $additional_param['is_permanent'] ?? true ;

        if(!$is_permanent){
            $this->deleteConversation($chat_id, $name);
        }

        return $conversation;
    }
}

?>
