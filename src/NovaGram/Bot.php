<?php

declare(strict_types=1);

namespace skrtdev\NovaGram;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\FirePHPHandler;

use skrtdev\Telegram\Exception as TelegramException;
use skrtdev\Telegram\Update;
use skrtdev\Prototypes\proto;

use skrtdev\async\Pool;

use Closure;
use Throwable;
use stdClass;
use ReflectionFunction;

class Bot {

    use Methods;
    use proto;

    const LICENSE = "NovaGram - An Object-Oriented PHP library for Telegram Bots".PHP_EOL."Copyright (c) 2020 Gaetano Sutera <https://github.com/skrtdev>";
    const NONE    = 0;
    const WEBHOOK = 1;
    const CLI     = 2;

    private string $token;
    private stdClass $settings;
    private array $json;
    private bool $payloaded = false;

    public ?Update $update = null; // read-only
    public ?array $raw_update = null; // read-only
    public int $id; // read-only
    public ?Database $database = null; // read-only

    private bool $started = false;
    private static bool $shown_license = false;

    private ?Closure $handler = null;
    private ?array $error_handlers = [];

    public ?Logger $logger = null;

    private ?string $file_sha = null;

    private Pool $pool;

    public function __construct(string $token, array $settings = [], ?Logger $logger = null) {

        if(!Utils::isTokenValid($token)){
            throw new Exception("Not a valid Telegram Bot Token provided ($token)");
        }
        $this->token = $token;
        $this->id = Utils::getIDByToken($token);
        $this->settings = (object) $settings;
        if(Utils::isCLI()){
            $this->pool = new Pool();
        }

        if(!isset($logger)){
            $logger = new Logger("NovaGram");
            if(Utils::isCLI()) $logger->pushHandler(new StreamHandler(STDERR, Logger::INFO));
            else $logger->pushHandler(new ErrorLogHandler(ErrorLogHandler::OPERATING_SYSTEM, Logger::INFO));
            $logger->debug('Logger automatically replaced by a default one');
        }
        $this->logger = $logger;

        $settings_array = [
            "json_payload" => true,
            "log_updates" => false,
            "debug" => false,
            "disable_webhook" => false,
            "disable_ip_check" => false,
            "exceptions" => true,
            "async" => true,
            "restart_on_changes" => false
        ];

        foreach ($settings_array as $name => $default){
            $this->settings->{$name} ??= $default;
        }

        if(!isset($this->settings->mode)){
            if($this->settings->disable_webhook){
                Utils::trigger_error("Using deprecated disable_webhook, check updated docs at https://docs.novagram.ga/construct.html", E_USER_DEPRECATED);
                $this->settings->mode = self::NONE;
            }
            else{
                $this->settings->mode = Utils::isCLI() ? self::CLI : self::WEBHOOK;
            }
        }
        if($this->settings->mode === "getUpdates"){
            Utils::trigger_error("Using deprecated \"getUpdates\" mode in settings, check updated docs at https://docs.novagram.ga/construct.html", E_USER_DEPRECATED);
            $this->settings->mode = self::CLI;
        }
        if($this->settings->mode === "webhook"){
            Utils::trigger_error("Using deprecated \"webhook\" mode in settings, check updated docs at https://docs.novagram.ga/construct.html", E_USER_DEPRECATED);
            $this->settings->mode = self::WEBHOOK;
        }
        if($this->settings->restart_on_changes){
            if($this->settings->mode === self::CLI){
                $this->file_sha = Utils::getFileSHA();
            }
            else{
                throw new Exception("restart_on_changes can be used only on CLI");
            }
        }

        $this->json = json_decode(implode(file(__DIR__."/json.json")), true);

        if(isset($this->settings->database)){
            $this->database = $this->db = new Database($this->settings->database);
        }

        $logger->debug("Chosen mode is: ". ($this->settings->mode === self::NONE ? "NONE" :"") . ($this->settings->mode === self::CLI ? "CLI" :"") . ($this->settings->mode === self::WEBHOOK ? "WEBHOOK" :""));

        if($this->settings->mode === self::WEBHOOK){
            if(!$this->settings->disable_ip_check){
                $logger->debug("IP Check is enabled");
                if(!isset($_SERVER['REMOTE_ADDR'])) exit;
                if(isset($_SERVER["HTTP_CF_CONNECTING_IP"]) and Utils::isCloudFlare()) $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                if(!Utils::ip_in_range($_SERVER['REMOTE_ADDR'], "149.154.160.0/20") and !Utils::ip_in_range($_SERVER['REMOTE_ADDR'], "91.108.4.0/22")) exit("Access Denied - Telegram IP Protection by NovaGram.ga");
            }
            if(file_get_contents("php://input") === "") exit("Access Denied");

            $this->raw_update = json_decode(file_get_contents("php://input"), true);

            if($this->settings->log_updates) $this->sendMessage($this->settings->log_updates, "<pre>".json_encode($this->raw_update, JSON_PRETTY_PRINT)."</pre>", ["parse_mode" => "HTML"]);

            $this->update = $this->JSONToTelegramObject($this->raw_update, "Update");
        }
        else{
            $this->settings->json_payload = false;
        }

        if($this->settings->debug !== false){
            $this->addErrorHandler(function (Throwable $e) {
                $this->debug( (string) $e );
            });
        }

    }

    public function setErrorHandler(...$args){
        Utils::trigger_error("Using deprecated setErrorHandler, use addErrorHandler instead", E_USER_DEPRECATED);
        $this->addErrorHandler(...$args);
    }

    public function addErrorHandler(Closure $handler){
        $this->error_handlers[] = $handler;
    }

    public function addHandler(...$args){
        Utils::trigger_error("Using deprecated addHandler, use onUpdate instead", E_USER_DEPRECATED);
        return $this->onUpdate(...$args);
    }

    public function onUpdate(Closure $handler){
        $this->handler = $handler;
        #return $this->idle();
    }


    protected function isAllowedThrowableType(Throwable $throwable, callable $callable): bool {
        $reflection = new ReflectionFunction($callable);

        $parameters = $reflection->getParameters();

        if (!isset($parameters[0])) {
            return false;
        }

        $firstParameter = $parameters[0];

        if (!$firstParameter) {
            return true;
        }

        $type = $firstParameter->getType();

        if (!$type) {
            return true;
        }

        if (is_a($throwable, $type->getName())) {
            return true;
        }

        return false;
    }

    protected function handleError(Throwable $e): void {
        $handled = false;
        foreach ($this->error_handlers as $handler) {
            if($this->isAllowedThrowableType($e, $handler)){
                $handled = true;
                $handler($e);
            }
        }
        if(!$handled){
            if(Utils::isCLI()){
                print(PHP_EOL.$e.PHP_EOL.PHP_EOL);
            }
            else{
                throw $e;
            }
        }

    }

    protected function handleUpdate(Update $update): void {
        $handler = $this->handler;
        try{
            $handler($update);
        }
        catch(Throwable $e){
            $this->handleError($e);
        }
    }

    protected function restartOnChanges(){
        if($this->settings->restart_on_changes){
            if($this->file_sha !== Utils::getFileSHA()){
                print(PHP_EOL."Restarting script...".PHP_EOL.PHP_EOL);
                shell_exec("php ".realpath($_SERVER['SCRIPT_FILENAME']));
                exit();
            }
        }
    }

    protected function processUpdates($offset = 0){
        $this->pool->resolveQueue();
        $async = $this->settings->async;
        $params = ['offset' => $offset, 'timeout' => 300];
        $this->logger->debug('Processing Updates (async: '.(int) $async.')', $params);
        $updates = $this->getUpdates($params);
        $handler = $this->handler;
        $this->restartOnChanges();
        foreach ($updates as $update) {
            if(!$async){
                $this->logger->info("Update handling started.", ['update_id' => $update->update_id]);
                $started = hrtime(true)/10**9;
                $this->handleUpdate($update);
                $this->logger->info("Update handling finished.", ['update_id' => $update->update_id, 'took' => (((hrtime(true)/10**9)-$started)*1000).'ms']);
            }
            else{
                $this->pool->parallel(function () use ($update) {
                    #$this->logger->info("Update handling started.", ['update_id' => $update->update_id]);
                    #$started = hrtime(true)/10**9;
                    $this->handleUpdate($update);
                    #$this->logger->info("Update handling finished.", ['update_id' => $update->update_id, 'took' => (((hrtime(true)/10**9)-$started)*1000).'ms']);
                });
            }
            $offset = $update->update_id+1;

        }
        return $offset;
    }

    protected function showLicense(): void {
        if(!self::$shown_license){
            print(self::LICENSE.PHP_EOL);
            self::$shown_license = true;
        }
    }

    public function idle(){
        if($this->settings->mode === self::CLI and !$this->started){
            if(isset($this->handler)){
                $this->deleteWebhook();
                $this->started = true;
                $this->showLicense();
                if(!isset($this->error_handlers)){
                    $this->logger->error("Error handler is not set.");
                }
                while (true) {
                    $offset = $this->processUpdates($offset ?? 0);
                }
            }
            else $this->logger->error("No handler is found, but idle() method has been called");
        }
    }

    public function __destruct(){
        $this->logger->debug("Triggered destructor");
        if(!$this->started){
            if(isset($this->handler)){
                if($this->settings->mode === self::CLI){
                    $this->logger->debug('Idling by destructor');
                    $this->idle();
                }
                if($this->settings->mode === self::WEBHOOK){
                    if(isset($this->update)){
                        $this->handleUpdate($this->update);
                    }
                }
            }
        }
    }

    private function methodHasParamater(string $method, string $parameter){
        return in_array($method, $this->json["require_params"][$parameter]);
    }

    private function normalizeRequest(string $method, array $data){
        if($this->methodHasParamater($method, "parse_mode") and isset($this->settings->parse_mode)){
            $data['parse_mode'] ??= $this->settings->parse_mode;
        }
        if($this->methodHasParamater($method, "disable_web_page_preview") and isset($this->settings->disable_web_page_preview)){
            $data['disable_web_page_preview'] ??= $this->settings->disable_web_page_preview;
        }
        if($this->methodHasParamater($method, "disable_notification") and isset($this->settings->disable_notification)){
            $data['disable_notification'] ??= $this->settings->disable_notification;
        }
        foreach ($this->json['require_json_encode'] as $key){

            if(isset($data[$key]) and is_array($data[$key])){

                $data[$key] = json_encode($data[$key]);
            }
        }
        return $data;
    }

    public function APICall(string $method, array $data = [], bool $payload = false, bool $is_debug = false, \Exception $previous_exception = null){

        $data = $this->normalizeRequest($method, $data);

        if($this->settings->json_payload){
            if($payload){
                if(!$this->payloaded){
                    $this->payloaded = true;
                    header('Content-Type: application/json');
                    $json = json_encode($data + ['method' => $method]);
                    echo $json;
                    return $json;
                }
                else{
                    Utils::trigger_error("Trying to use JSON Payload more than one time");
                }
            }
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot{$this->token}/$method");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);
        if(is_bool($response)) return $this->APICall(...func_get_args());
        $decoded = json_decode($response, true);

        if($decoded['ok'] !== true){
            $this->logger->debug("Response: ".$response);
            if($is_debug) throw TelegramException::create("[DURING DEBUG] $method", $decoded, $data, $previous_exception);
            $e = TelegramException::create($method, $decoded, $data);
            if($this->settings->debug){
                #$this->sendMessage($this->settings->debug, "<pre>".$method.PHP_EOL.PHP_EOL.print_r($data, true).PHP_EOL.PHP_EOL.print_r($decoded, true)."</pre>", ["parse_mode" => "HTML"], false, true);
                #$this->debug( (string) $e, $previous_exception);
            }
            if($this->settings->exceptions) throw $e;
            else return (object) $decoded;
        }

        if(is_bool($decoded['result'])) return $decoded['result'];

        if($this->getMethodReturned($method)) return $this->JSONToTelegramObject($decoded['result'], $this->getMethodReturned($method));
        else return is_array($decoded['result']) ? (object) $decoded['result'] : $decoded['result'];
    }

    private function getMethodReturned(string $method){
        return $this->json['available_methods'][$method]['returns'] ?? false;
    }

    private function getObjectType(string $parameter_name, string $object_name = ""){
        if($object_name !== "") $object_name .= ".";
        return $this->json['available_types'][$object_name.$parameter_name] ?? false;
    }

    public function JSONToTelegramObject(array $json, string $parameter_name){
        if($this->getObjectType($parameter_name)) $parameter_name = $this->getObjectType($parameter_name);
        if(preg_match('/\[\w+\]/', $parameter_name) === 1) return $this->TelegramObjectArrayToStdClass($json, $parameter_name);
        foreach($json as $key => &$value){
            if(is_array($value)){
                $ObjectType = $this->getObjectType($key, $parameter_name);
                if($ObjectType){
                    if($this->getObjectType($ObjectType)) $value = $this->TelegramObjectArrayToStdClass($value, $ObjectType);
                    else $value = $this->JSONToTelegramObject($value, $ObjectType);
                }
                else $value = (object) $value;
            }
        }
        return $this->createObject($parameter_name, $json);
    }

    private function TelegramObjectArrayToStdClass(array $json, string $name){
        $parent_name = $name;
        $ObjectType = $this->getObjectType($name) !== false ? $this->getObjectType($name) : $name;

        if(preg_match('/\[\w+\]/', $ObjectType) === 1){
            preg_match('/\w+/', $ObjectType, $matches);// extract to matches[0] the type of elements
            $childs_name = $matches[0];
        }
        else $childs_name = $ObjectType;

        foreach($json as $key => &$value){
            if(is_array($value)){
                if(is_int($key)){
                    if($this->getObjectType($childs_name)) $value = $this->TelegramObjectArrayToStdClass($value, $childs_name);
                    //else $value = $this->createObject($childs_name, $value);
                    else $value = $this->JSONToTelegramObject($value, $childs_name);
                }
                else $value = $this->JSONToTelegramObject($value, $this->getObjectType($childs_name, $parent_name));

            }
        }
        return (object) $json;

    }

    public static function curl(string $url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }


    public static function getUsernameDC(string $username){
        preg_match('/cdn(\d)/', self::curl("https://t.me/$username"), $matches);
        return isset($matches[1]) ? (int) $matches[1] : false;
    }

    public function createObject(string $type, array $json){
        $obj = "\\skrtdev\\Telegram\\$type";
        return new $obj($type, $json, $this);
    }

    public function debug($value, ?Throwable $previous_exception = null){
        if($this->settings->debug){
            return $this->APICall("sendMessage", [
                "chat_id" => $this->settings->debug,
                "text" => "<pre>".htmlspecialchars(print_r($value, true))."</pre>",
                "parse_mode" => "HTML"
            ], false, true, $previous_exception);
        }
        else throw new Exception("debug chat id is not set");
    }

    public function getJSON(): array{
        return $this->json;
    }

    public function getDatabase(): Database{
        return $this->database;
    }

    public function __debugInfo() {
        $result = get_object_vars($this);
        foreach(['json', 'settings', 'payloaded', 'raw_update'] as $key) unset($result[$key]);
        return $result;
    }
}
?>
