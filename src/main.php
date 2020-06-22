<?php

class TelegramBot {
    private $token, $settings, $json;
    private $payloaded = false;
    public $file;

    public function __construct(string $token, array $settings = []) {
        $this->token = $token;
        $this->file = "https://api.telegram.org/file/bot$token/";
        $this->settings = (object) $settings;
        $this->json = json_decode(implode(file(__DIR__."/json.json")), true);

        if($this->settings->disable_webhook !== true){
            $this->settings->json_payload = false;
            if($this->settings->disable_ip_check !== true){
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

            if($this->settings->log_updates) $this->sendMessage(["chat_id" => $this->settings->log_updates_chat_id ? $this->settings->log_updates_chat_id : 634408248, "text" => json_encode($this->raw_update, JSON_PRETTY_PRINT)]);

            $this->update = $this->JSONToTelegramObject( $this->raw_update, "Update");
        }
    }

    public function __call(string $name, array $arguments){
        return $this->APICall($name, $arguments[0], isset($arguments[1]) ? true : false);
    }

    public function APICall(string $method, array $data, bool $payload = false){

        if($this->settings->json_payload and !$this->payloaded and $payload){
            $this->payloaded = true;
            $data['method'] = $method;
            echo json_encode($data);
            return true;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.telegram.org/bot'.$this->token.'/'.$method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);
        $decoded =  json_decode($output, TRUE);

        if($decoded['ok'] !== true){
            if($this->settings->debug){
                return $this->sendMessage(["chat_id" => $this->settings->debug_chat_id ? $this->settings->debug_chat_id : 634408248, "text" => $method.PHP_EOL.PHP_EOL.print_r($data, true).PHP_EOL.PHP_EOL.print_r($decoded, true)]);
            }
            return (object) $decoded;
        }

        if(gettype($decoded['result']) === "boolean") return $decoded['result'];

        if($this->getMethodReturned($method)) return $this->JSONToTelegramObject($decoded['result'], $this->getMethodReturned($method));
    }

    private function getMethodReturned(string $method){
        if(isset($this->json['available_methods'][$method]['returns']) ) return $this->json['available_methods'][$method]['returns'] !== "_" ? $this->json['available_methods'][$method]['returns'] : false;
        foreach ($this->json['available_methods_regxs'] as $key => $value) {
            if(preg_match('/'.base64_decode($key).'/', $method) === 1) return $value['returns'];
        }
        return false;
    }

    private function getObjectType(string $parameter_name, string $object_name = ""){
        if($object_name != "") $object_name .= ".";
        return isset($this->json['available_types'][$object_name.$parameter_name]) ? $this->json['available_types'][$object_name.$parameter_name] : false;
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
                    else $json[$key] = new TelegramObject($childs_name, $value, $this);
                }
                else $json[$key] = $this->JSONToTelegramObject($value, $this->getObjectType($childs_name, $parent_name));

            }
        }
        return new TelegramObject($name, $json, $this);

    }

    private function curl(string $url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public function getUserDC(TelegramObject $user){
        if($user->_ !== "User") throw new Exception("Argument passed to getUserDC is not an user");
        if($user->username === null) throw new Exception("User passed to getUserDC has not an username");
        preg_match('/cdn(\d)/', $this->curl("https://t.me/{$user->username}"), $matches);
        return intval($matches[1] !== 0 ? $matches[1] : false);
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

        //$json = json_decode(json_encode($json));

        foreach ($json as $key => $value){
            if($key === "file_path") $value = $TelegramBot->file.$value;
            $this->$key = $value;
        }

        $this->config = json_decode(implode(file(__DIR__."/json.json")));
    }
    public function __call(string $name, array $arguments){
        if($name === "getDC"){
            if($this->_ !== "User") throw new Exception("Argument passed to getDC is not an user");
            if($this->username === null) throw new Exception("User passed to getDC has not an username");
            return $this->TelegramBot->getUserDC($this);
        }

        $this_obj = $this->config->types_methods->{$this->_};
        $this_method = $this_obj->{$name};

        $presets = $this_method->presets;
        $data = [];

        if(isset($this_obj->_presets)) foreach ($this_obj->_presets as $key => $value) {
            $data[$key] = $this->presetToValue($value);
        }
        if(isset($presets)) foreach ($presets as $key => $value) {
            $data[$key] = $this->presetToValue($value);
        }
        if(gettype($arguments[0]) === "array") foreach ($arguments[0] as $key => $value) {
            $data[$key] = $value;
        }
        elseif(isset($arguments[0])){
            if($this_method->just_one_parameter_needed !== null) $data[$this_method->just_one_parameter_needed] = $arguments[0];
            //elseif($this_method->no_more_parameters_needed === null) throw new Exception("TelegramObject({$this->_})::$name called without parameters." );
        }
        if(count($data) === 0) throw new Exception("TelegramObject({$this->_})::$name called without parameters." );

        return $this->TelegramBot->APICall($this_method->alias, $data, isset($arguments[1]) ? true : false);
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
