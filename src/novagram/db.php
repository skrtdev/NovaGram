<?php

# namespace NovaGram;

class Database{

    const driver_options = [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY];

    private array $settings;
    private PDO $PDO;
    private string $prefix;

    public function __construct(array $settings, ?string $prefix = "novagram"){

        $settings_array = [
            "driver" => "mysql",
            "host" => "localhost:3306"
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

        $this->PDO = new \PDO("$driver:$connection", $dbuser, $dbpass, $options);

        $this->prefix = isset($prefix) ? $prefix."_" : "";


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
        ];
    }

    private function initializeDatabase(): void{
        $this->query("CREATE TABLE IF NOT EXISTS {$this->tableNames['users']} (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            user_id BIGINT(255) UNIQUE
        )");
    }

    public function initializeConversations(): void{
        $this->query("CREATE TABLE IF NOT EXISTS {$this->tableNames['conversations']} (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            chat_id BIGINT(255),
            name VARCHAR(64) NOT NULL,
            value VARCHAR(64) NOT NULL,
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
            ':value' => $value,
            ':additional_param' => serialize($additional_param) ?? "",
        ]);
    }
    public function getConversation(int $chat_id, string $name, ?\Telegram\Update $update){
        $row = $this->query($this->queries['getConversation'], [
            ':chat_id' => $chat_id,
            ':name' => $name,
        ])->fetch();

        if($row === false) return;

        $value = $row['value'];
        $additional_param = unserialize($row['additional_param']);

        $is_permanent = $additional_param['is_permanent'];
        unset($additional_param['is_permanent']);

        if($name === "status"){
            if(!empty($additional_param)){
                //var_dump($update);
                //if(!isset($update) || !isset($update->message->text)){
                /*if(!isset($update)){
                    echo "\n\n\n\n\nNO UPDATE \n\n\n\n\n";
                    return;
                }*/
                if(!isset($update->message)){
                    echo "\n\n\n\n\nNO UPDATE MESSAGE \n\n\n\n\n";
                    return;
                }

                foreach ($additional_param as $key => $value) {
                    if($key === "regex"){
                        if(isset($update->message->text)){
                            var_dump("ora dovrebbe checkare la regex"); // >TODO
                        }
                        else return;
                    }
                    else{
                        if(isset($update->message->{$value})) break;
                    }
                }
            }
        }
        var_dump($additional_param);
        #['value'];
        if(!$is_permanent){
            trigger_error("$chat_id->$name has to be deleted (is_permanent: $is_permanent)");
            $this->deleteConversation($chat_id, $name);
        }
        return $value;
    }


    public function insertUser(\Telegram\User $user): void {
        if(!$this->existQuery($this->queries['selectUser'], [':user_id' => $user->id])){
            $sth = $this->query($this->queries['insertUser'], [
                ':user_id' => $user->id,
            ]);
        }
    }

    public function getLastInsertId(): int{
        return $this->PDO->query("SELECT LAST_INSERT_ID() as id")->fetch()['id'];
    }

    public function query(string $query, array $params = []){
        $sth = $this->PDO->prepare($query, self::driver_options);
        $sth->execute($params);
        return $sth;
    }
    public function existQuery(string $query, array $params = []): bool{
        $sth = $this->query($query, $params);
        var_dump($sth);
        return !is_bool($sth->fetch());
    }

    public function getPDO(): PDO{
        return $this->PDO;
    }
}

?>
