<?php

namespace Telegram;

class Bot {
    private $token, $settings, $json;
    private $payloaded = false;

    public function __construct(string $token, array $settings = []) {
        $this->token = $token;
        $this->settings = (object) $settings;

        $settings_array = [
            "json_payload" => true,
            "log_updates" => false,
            "debug" => false,
            "disable_webhook" => false,
            "disable_ip_check" => false,
            "exceptions" => true
        ];

        foreach ($settings_array as $name => $default) $this->settings->{$name} = $this->settings->{$name} ?? $default;

        $this->json = json_decode(implode(file(__DIR__."/json.json")), true);

        if(!$this->settings->disable_webhook){
            http_response_code(200);
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
                if(!ip_in_range($_SERVER['REMOTE_ADDR'], "149.154.160.0/20") and !ip_in_range($_SERVER['REMOTE_ADDR'], "91.108.4.0/22")) die("Access Denied");
            }
            if(file_get_contents("php://input") === "") die("Access Denied");

            $this->raw_update = json_decode(file_get_contents("php://input"), true);

            if($this->settings->log_updates) $this->sendMessage(["chat_id" => $this->settings->log_updates, "text" => "<pre>".json_encode($this->raw_update, JSON_PRETTY_PRINT)."</pre>", "parse_mode" => "HTML"]);

            $this->update = $this->JSONToTelegramObject($this->raw_update, "Update");
        }
        else $this->settings->json_payload = false;
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
                    $data['method'] = $method;
                    echo json_encode($data);
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

    private function JSONToTelegramObject(array $json, string $parameter_name){
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
        $c = "\\Telegram\\$type";
        return new $c($type, $json, $this);
    }

    public function __debugInfo() {
        $result = get_object_vars($this);
        foreach(['json', 'config', 'settings', 'payloaded', 'raw_update'] as $key) unset($result[$key]);
        return $result;
    }
}

class Type {
    private $Bot, $config, $_;
    public function __construct(string $type, array $json, Bot $Bot){

        $this->_ = $type;
        $this->Bot = $Bot;

        foreach ($json as $key => $value) $this->$key = $value;

        $this->config = json_decode(implode(file(__DIR__."/json.json")));

    }
    public function __call(string $name, array $arguments){

        if(!property_exists($this->config->types_methods, $this->_)) throw new \NovaGram\Exception("There are no available Methods for a {$this->_} Object (trying to call $name)");
        $this_obj = $this->config->types_methods->{$this->_};

        if(!isset($this_obj->{$name})) throw new \Error("Call to undefined method ".self::class."::$name()");
        $this_method = $this_obj->{$name};

        $data = [];

        foreach ($this_obj->_presets ?? [] as $key => $value) {
            $data[$key] = $this->presetToValue($value);
        }
        foreach ($this_method->presets ?? [] as $key => $value) {
            $data[$key] = $this->presetToValue($value);
        }
        foreach ($this_method->defaults ?? [] as $key => $value) {
            $data[$key] = $value;
        }
        if(is_array($arguments[0])) foreach ($arguments[0] as   $key => $value) {
            $data[$key] = $value;
        }
        elseif(isset($arguments[0])){
            if(isset($this_method->just_one_parameter_needed)) $data[$this_method->just_one_parameter_needed] = $arguments[0];
        }
        if(count($data) === 0) throw new \ArgumentCountError("Too few arguments to function ".self::class."::$name(), 0 passed");

        return $this->Bot->{$this_method->alias ?? $name}($data, $arguments[1] ?? false);
    }

    private function presetToValue(string $preset){
        $obj = $this;
        foreach(explode("/", $preset) as $key) $obj = $obj->$key;
        return $obj;
    }

    public function __debugInfo() {
        $result = get_object_vars($this);
        foreach(['json', 'config', 'Bot', 'settings', 'payloaded', 'raw_update'] as $key) unset($result[$key]);
        return $result;
    }
}

?>
