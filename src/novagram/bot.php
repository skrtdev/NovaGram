<?php

namespace skrtdev\NovaGram;

class Bot {
    private string $token;
    private \stdClass $settings;
    private array $json;
    private bool $payloaded = false;

    public \skrtdev\Telegram\Update $update; // read-only
    public array $raw_update; // read-only
    public int $id; // read-only


    public function __construct(string $token, array $settings = []) {
        if(!Utils::isTokenValid($token)){
            throw new Exception("Not a valid Telegram Bot Token provided ($token)");
        }
        $this->token = $token;
        $this->id = Utils::getIDByToken($token);
        $this->settings = (object) $settings;


        $settings_array = [
            "json_payload" => true,
            "log_updates" => false,
            "debug" => false,
            "disable_webhook" => false,
            "disable_ip_check" => false,
            "exceptions" => true
        ];

        foreach ($settings_array as $name => $default){
            $this->settings->{$name} ??= $default;
        }

        $this->json = json_decode(implode(file(__DIR__."/json.json")), true);

        if(!$this->settings->disable_webhook){
            if(!$this->settings->disable_ip_check){
                if(isset($_SERVER["HTTP_CF_CONNECTING_IP"]) and Utils::isCloudFlare()) $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                if(!Utils::ip_in_range($_SERVER['REMOTE_ADDR'], "149.154.160.0/20") and !Utils::ip_in_range($_SERVER['REMOTE_ADDR'], "91.108.4.0/22")) exit("Access Denied");
            }
            if(file_get_contents("php://input") === "") exit("Access Denied");

            $this->raw_update = json_decode(file_get_contents("php://input"), true);

            if($this->settings->log_updates) $this->sendMessage(["chat_id" => $this->settings->log_updates, "text" => "<pre>".json_encode($this->raw_update, JSON_PRETTY_PRINT)."</pre>", "parse_mode" => "HTML"]);

            $this->update = $this->JSONToTelegramObject($this->raw_update, "Update");
        }
        else $this->settings->json_payload = false;



        if(isset($this->settings->database)){
            $this->database = $this->db = new Database($this->settings->database, $this->settings->database['prefix']);
        }
    }

    public function __call(string $name, array $arguments){
        return $this->APICall($name, ...$arguments);
    }

    public function APICall(string $method, array $data, bool $payload = false, bool $force_throw_exception = false){
        if(in_array($method, $this->json['require_parse_mode']) and isset($this->settings->parse_mode)) $data['parse_mode'] = $data['parse_mode'] ?? $this->settings->parse_mode;
        foreach ($this->json['require_json_encode'] as $key) if(isset($data[$key]) and is_array($data[$key])) $data[$key] = json_encode($data[$key]);

        if($this->settings->json_payload){
            if($payload){
                if(!$this->payloaded){
                    $this->payloaded = true;
                    echo json_encode($data + ['method' => $method]);
                    return true;
                }
                else{
                    trigger_error("Trying to use JSON Payload more than one time");
                }
            }
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot{$this->token}/$method");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);
        $decoded =  json_decode($output, TRUE);

        if($decoded['ok'] !== true){
            if($force_throw_exception) throw new \Telegram\Exception("[DURING DEBUG] $method", $decoded, $data);
            if($this->settings->debug){
                $this->sendMessage(["chat_id" => $this->settings->debug, "text" => "<pre>".$method.PHP_EOL.PHP_EOL.print_r($data, true).PHP_EOL.PHP_EOL.print_r($decoded, true)."</pre>", "parse_mode" => "HTML"], false, true);
            }
            if($this->settings->exceptions) throw new \Telegram\Exception($method, $decoded, $data);
            else return (object) $decoded;
        }

        if(is_bool($decoded['result'])) return $decoded['result'];

        if($this->getMethodReturned($method)) return $this->JSONToTelegramObject($decoded['result'], $this->getMethodReturned($method));
        else return is_array($decoded['result']) ? (object) $decoded['result'] : $decoded['result'];
    }

    private function getMethodReturned(string $method){
        if(isset($this->json['available_methods'][$method]['returns']) ) return $this->json['available_methods'][$method]['returns'] !== "_" ? $this->json['available_methods'][$method]['returns'] : false;
        foreach ($this->json['available_methods_regxs'] as $key => $value) if(preg_match('/'.$key.'/', $method) === 1) return $value['returns'];
        return false;
    }

    private function getObjectType(string $parameter_name, string $object_name = ""){
        if($object_name !== "") $object_name .= ".";
        return $this->json['available_types'][$object_name.$parameter_name] ?? false;
    }

    public function JSONToTelegramObject(array $json, string $parameter_name){
        if($this->getObjectType($parameter_name)) $parameter_name = $this->getObjectType($parameter_name);
        if(preg_match('/\[\w+\]/', $parameter_name) === 1) return $this->TelegramObjectArrayToTelegramObject($json, $parameter_name);
        foreach($json as $key => $value){
            if(is_array($value)){
                $ObjectType = $this->getObjectType($key, $parameter_name);
                if($ObjectType){
                    if($this->getObjectType($ObjectType)) $json[$key] = $this->TelegramObjectArrayToTelegramObject($value, $ObjectType);
                    else $json[$key] = $this->JSONToTelegramObject($value, $ObjectType);
                }
                else $json[$key] = (object) $value;
            }
        }
        return $this->createObject($parameter_name, $json);
    }

    private function TelegramObjectArrayToTelegramObject(array $json, string $name){
        $parent_name = $name;
        $ObjectType = $this->getObjectType($name) !== false ? $this->getObjectType($name) : $name;

        if(preg_match('/\[\w+\]/', $ObjectType) === 1){
            preg_match('/\w+/', $ObjectType, $matches);// extract to matches[0] the type of elements
            $childs_name = $matches[0];
        }
        else $childs_name = $ObjectType;

        foreach($json as $key => $value){
            if(is_array($value)){
                if(is_int($key)){
                    if($this->getObjectType($childs_name)) $json[$key] = $this->TelegramObjectArrayToTelegramObject($value, $childs_name);
                    //else $json[$key] = $this->createObject($childs_name, $value);
                    else $json[$key] = $this->JSONToTelegramObject($value, $childs_name);
                }
                else $json[$key] = $this->JSONToTelegramObject($value, $this->getObjectType($childs_name, $parent_name));

            }
        }
        return (object) $json;

    }

    public static function curl(string $url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }


    public static function getUsernameDC(string $username){
        preg_match('/cdn(\d)/', self::curl("https://t.me/{$username}"), $matches);
        return isset($matches[1]) ? (int) $matches[1] : false;
    }

    public function createObject(string $type, array $json){
        $obj = "\\skrtdev\\Telegram\\$type";
        return new $obj($type, $json, $this);
    }

    public function debug($value){
        if($this->settings->debug){
            return $this->sendMessage([
                "chat_id" => $this->settings->debug,
                "text" => "<pre>".htmlspecialchars(print_r($value, true))."</pre>",
            ]);
        }
        else throw new Exception("debug chat id is not set");
    }

    public function getJSON(): array{
        return $this->json;
    }

    public function __debugInfo() {
        $result = get_object_vars($this);
        foreach(['json', 'settings', 'payloaded', 'raw_update'] as $key) unset($result[$key]);
        return $result;
    }
}
?>
