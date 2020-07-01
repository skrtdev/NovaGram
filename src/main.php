<?php

class TelegramBot {
    private $token, $settings, $json;
    private $payloaded = false;

    public function __construct(string $token, array $settings = []) {
        $this->token = $token;
        $this->settings = (object) $settings;
        $this->client = new GuzzleHttp\Client(['base_uri' => "https://api.telegram.org/bot{$token}/"]);

        $this->settings->json_payload = (bool) $this->settings->json_payload ?? false;
        $this->settings->log_updates = (bool) $this->settings->log_updates ?? false;
        $this->settings->log_updates_chat_id = $this->settings->log_updates_chat_id ?? 634408248;
        $this->settings->debug = (bool) $this->settings->debug ?? false;
        $this->settings->debug_chat_id = $this->settings->debug_chat_id ?? 634408248;
        $this->settings->disable_ip_check = (bool) $this->settings->disable_ip_check ?? false;
        $this->settings->disable_webhook = (bool) $this->settings->disable_webhook ?? false;
        $this->settings->exceptions = (bool) $this->settings->exceptions ?? true;
        $this->settings->async = (bool) $this->settings->async ?? false;

        $this->json = json_decode(implode(file(__DIR__."/json.json")), true);

        if(!$this->settings->disable_webhook){
            if(!$this->settings->disable_ip_check){
                function ip_in_range( $ip, $range ) {
                    if ( strpos( $range, '/' ) === false ) $range .= '/32';
                    list( $range, $netmask ) = explode( '/', $range, 2 );
                    $range_decimal = ip2long( $range );
                    $ip_decimal = ip2long( $ip );
                    $wildcard_decimal = pow( 2, ( 32 - $netmask ) ) - 1;
                    $netmask_decimal = ~ $wildcard_decimal;
                    return ( ( $ip_decimal & $netmask_decimal ) == ( $range_decimal & $netmask_decimal ) );
                }
                function isCloudFlare() {
                    $cf_ips = ['173.245.48.0/20','103.21.244.0/22','103.22.200.0/22','103.31.4.0/22','141.101.64.0/18','108.162.192.0/18','190.93.240.0/20','188.114.96.0/20','197.234.240.0/22','198.41.128.0/17','162.158.0.0/15','104.16.0.0/12','172.64.0.0/13','131.0.72.0/22'];
                    foreach ($cf_ips as $cf_ip) if (ip_in_range($_SERVER['REMOTE_ADDR'], $cf_ip)) return true;
                    return false;
                }
                if(isset($_SERVER["HTTP_CF_CONNECTING_IP"]) and isCloudFlare()) $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                if( (!ip_in_range($_SERVER['REMOTE_ADDR'], "149.154.160.0/20") and !ip_in_range($_SERVER['REMOTE_ADDR'], "91.108.4.0/22")) or file_get_contents("php://input") === "") die("Access Denied");
            }
            $this->raw_update = json_decode(file_get_contents("php://input"), true);

            if($this->settings->log_updates) $this->sendMessage(["chat_id" => $this->settings->log_updates_chat_id, "text" => json_encode($this->raw_update, JSON_PRETTY_PRINT)]);

            $this->update = $this->JSONToTelegramObject($this->raw_update, "Update");
        }
        else $this->settings->json_payload = false;
    }

    public function __call(string $name, array $arguments){
        return $this->APICall($name, $arguments[0], $arguments[1] ?? false);
    }

    public function APICall(string $method, array $data, bool $payload = false){
        if(in_array($method, $this->json['require_parse_mode']) and isset($this->settings->parse_mode)) $data['parse_mode'] = $data['parse_mode'] ?? $this->settings->parse_mode;
        foreach ($this->json['require_json_encode'] as $key) if(isset($data[$key]) and gettype($data[$key]) === "array") $data[$key] = json_encode($data[$key]);

        if($this->settings->json_payload and !($this->payloaded) and $payload){
            $this->payloaded = true;
            $data['method'] = $method;
            echo json_encode($data);
            return true;
        }


        $output = $this->client->request("POST", $method, [
            "json" => $data,
            "http_errors" => false
        ])->getBody();

        $decoded = json_decode($output, TRUE);

        if($decoded['ok'] !== true){
            if($this->settings->debug){
                $this->sendMessage(["chat_id" => $this->settings->debug_chat_id, "text" => $method.PHP_EOL.PHP_EOL.print_r($data, true).PHP_EOL.PHP_EOL.print_r($decoded, true)]);
            }
            if($this->settings->exceptions) throw new TelegramException("Error while calling $method method: ".$decoded['description'], $decoded['error_code']);
        }

        if(gettype($decoded['result']) === "boolean") return $decoded['result'];

        if($this->getMethodReturned($method)) return $this->JSONToTelegramObject($decoded['result'], $this->getMethodReturned($method));
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

    private function JSONToTelegramObject(array $json, string $parameter_name){
        if($this->getObjectType($parameter_name)) $parameter_name = $this->getObjectType($parameter_name);
        if(preg_match('/\[\w+\]/', $parameter_name) === 1) return $this->TelegramObjectArrayToTelegramObject($json, $parameter_name);
        foreach($json as $key => $value){
            if(gettype($value) === "array"){
                $ObjectType = $this->getObjectType($key, $parameter_name);
                if($ObjectType){
                    if($this->getObjectType($ObjectType)) $json[$key] = $this->TelegramObjectArrayToTelegramObject($value, $ObjectType);
                    else $json[$key] = $this->JSONToTelegramObject($value, $ObjectType);
                }
            }
        }
        return new TelegramObject($parameter_name, $json, $this);
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
            if(gettype($value) === "array"){
                if(gettype($key) === "integer"){
                    if($this->getObjectType($childs_name)) $json[$key] = $this->TelegramObjectArrayToTelegramObject($value, $childs_name);
                    //else $json[$key] = new TelegramObject($childs_name, $value, $this);
                    else $json[$key] = $this->JSONToTelegramObject($value, $childs_name);
                }
                else $json[$key] = $this->JSONToTelegramObject($value, $this->getObjectType($childs_name, $parent_name));

            }
        }
        return new TelegramObject($name, $json, $this);

    }


    public function getUserDC(TelegramObject $user){
        if($user->_ !== "User") throw new NovaGramException("Argument passed to getUserDC is not an user");
        if($user->username === null) throw new NovaGramException("User passed to getUserDC has not an username");
        preg_match('/cdn(\d)/', $this->client->get("https://t.me/{$user->username}")->getBody(), $matches);
        return intval($matches[1]) !== 0 ? intval($matches[1]) : false;
    }

    public function __debugInfo() {
        $result = get_object_vars($this);
        foreach(['json', 'config', 'TelegramBot', 'settings', 'payloaded', 'raw_update'] as $key) unset($result[$key]);
        return $result;
    }
}

class TelegramObject {
    private $TelegramBot, $config;
    public function __construct(string $type, array $json, TelegramBot $TelegramBot){

        $this->_ = $type;
        $this->TelegramBot = $TelegramBot;

        foreach ($json as $key => $value) $this->$key = $value;

        $this->config = json_decode(implode(file(__DIR__."/json.json")));
    }
    public function __call(string $name, array $arguments){
        if($name === "getDC"){
            if($this->_ !== "User") throw new NovaGramException("Argument passed to getDC is not an user");
            if($this->username === null) throw new NovaGramException("User passed to getDC has not an username");
            return $this->TelegramBot->getUserDC($this);
        }

        $this_obj = $this->config->types_methods->{$this->_};
        if($this_obj === null) throw new NovaGramException("There are no available Methods for a {$this->_} Object (trying to yse $name)");

        $this_method = $this_obj->{$name};
        if($this_obj === null) throw new NovaGramException("$name is not a Method of a {$this->_} Object");

        $presets = $this_method->presets;
        $data = [];

        if(isset($this_obj->_presets)) foreach ($this_obj->_presets as $key => $value) {
            $data[$key] = $this->presetToValue($value);
        }
        if(isset($presets)) foreach ($presets as $key => $value) {
            $data[$key] = $this->presetToValue($value);
        }
        if(isset($this_method->defaults)) foreach ($this_method->defaults as $key => $value) {
            $data[$key] = $value;
        }
        if(gettype($arguments[0]) === "array") foreach ($arguments[0] as $key => $value) {
            $data[$key] = $value;
        }
        elseif(isset($arguments[0])){
            if($this_method->just_one_parameter_needed !== null) $data[$this_method->just_one_parameter_needed] = $arguments[0];
            //elseif($this_method->no_more_parameters_needed === null) throw new NovaGramException("TelegramObject({$this->_})::$name called without parameters." );
        }
        if(count($data) === 0) throw new NovaGramException("TelegramObject({$this->_})::$name called without parameters." );

        return $this->TelegramBot->APICall($this_method->alias, $data, $arguments[1] ?? false);
    }

    private function presetToValue(string $preset){
        $obj = $this;
        foreach(explode("/", $preset) as $key) $obj = $obj->$key;
        return $obj;
    }

    public function __debugInfo() {
        $result = get_object_vars($this);
        foreach(['json', 'config', 'TelegramBot', 'settings', 'payloaded'] as $key) unset($result[$key]);
        return $result;
    }
}

?>
