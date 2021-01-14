<?php declare(strict_types=1);

namespace skrtdev\NovaGram;

use Monolog\Logger;
use Monolog\Handler\{StreamHandler, ErrorLogHandler};

use skrtdev\Telegram\{
    Update,
    ObjectsList,
    Exception as TelegramException,
    BadGatewayException,
    TooManyRequestsException
};
use skrtdev\Prototypes\proto;

use Closure;
use Throwable;
use stdClass;

class Bot {

    use Methods;
    use HandlersTrait;
    use proto;

    const LICENSE = "NovaGram - An Object-Oriented PHP library for Telegram Bots".PHP_EOL."Copyright (c) 2020 Gaetano Sutera <https://github.com/skrtdev>";
    const NONE    = 0;
    const WEBHOOK = 1;
    const CLI     = 2;
    const TIMEOUT = 300;

    const COMMAND_PREFIX = '/';

    private string $token;
    protected stdClass $settings;
    private array $json;
    private bool $payloaded = false;

    public ?Update $update = null; // read-only
    public ?array $raw_update = null; // read-only
    public int $id; // read-only
    private string $username; // read-only
    protected ?Database $database = null; // read-only
    protected string $endpoint;

    private bool $started = false;
    private bool $running = false;
    private static bool $shown_license = false;
    private bool $is_handling = false;
    private ?string $file_sha = null;

    public Logger $logger;
    private Dispatcher $dispatcher;

    public function __construct(string $token, array $settings = [], ?Logger $logger = null, ...$kwargs) {

        $this->initializeToken($token);

        $this->settings = $this->normalizeSettings($settings + $kwargs);

        $this->initializeLogger($logger);
        $this->initializeEndpoint();

        $this->processSettings();
    }

    protected function initializeToken(string $token): void
    {
        if(!Utils::isTokenValid($token)){
            throw new Exception("Not a valid Telegram Bot Token provided ($token)");
        }
        $this->token = $token;
        $this->id = Utils::getIDByToken($token);
    }

    protected function initializeEndpoint(): void
    {
        $this->endpoint = trim($this->settings->bot_api_url, '/').'/'.($this->settings->is_user ? 'user' : 'bot')."{$this->token}/";
    }

    protected function initializeLogger(?Logger $logger = null)
    {
        if(!isset($logger)){
            $logger = new Logger("NovaGram");
            if(Utils::isCLI()) $logger->pushHandler(new StreamHandler(STDERR, $this->settings->logger));
            else $logger->pushHandler(new ErrorLogHandler(ErrorLogHandler::OPERATING_SYSTEM, $this->settings->logger));
            if($this->settings->debug !== false){
                $logger->pushHandler(new TelegramLogger($this->token, $this->settings->debug, Logger::WARNING));
            }
            $logger->debug('Logger automatically replaced by a default one');
        }
        $this->logger = $logger;
    }

    protected function normalizeSettings(array $settings){
        $settings = (object) ($settings);

        $settings_array = [
            "username" => null,
            "json_payload" => true,
            "log_updates" => false,
            "debug" => false,
            "disable_webhook" => false,
            "disable_ip_check" => false,
            "exceptions" => true,
            "async" => true,
            "restart_on_changes" => false,
            "logger" => Logger::INFO,
            "bot_api_url" => "https://api.telegram.org",
            "is_user" => false,
            "command_prefixes" => [self::COMMAND_PREFIX],
            "group_handlers" => true,
            "wait_handlers" => false,
            "threshold" => null, // 10 is default when using getUpdates
            "export_commands" => true,
            "include_classes" => Utils::isCLI(),
            "database" => null,
            "parse_mode" => null,
            "disable_web_page_preview" => null,
            "disable_notification" => null,
            "debug_mode" => "classic", // BC
        ];

        foreach ($settings_array as $name => $default){
            $settings->{$name} ??= $default;
        }

        foreach ($settings->command_prefixes as &$prefix){
            $prefix = preg_quote($prefix, '/');
        }
        return $settings;
    }

    protected function processSettings(): void
    {

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


        $database = $this->settings->database;
        if(isset($database)){
            if(is_array($database)){
                $this->database = new Database($database);
            }
            elseif($database instanceof \PDO){
                $this->database = new Database([], $database);
            }
            else{
                throw new Exception("Bot database parameter must be an array or an instance of PDO, ".gettype($database)." passed");
            }
        }


        if($this->settings->mode === self::WEBHOOK){
            if(!$this->settings->disable_ip_check){
                $this->logger->debug("IP Check is enabled");
                if(!Utils::isTelegram()){
                    http_response_code(403);
                    exit("Access Denied - Telegram IP Protection by NovaGram.ga");
                }
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

        if($this->settings->mode === self::CLI){
            $this->getUsername();

            if($this->settings->wait_handlers){
                pcntl_async_signals(true);
                pcntl_signal(SIGINT, [$this, "stop"]);
            }
            if($this->settings->restart_on_changes){
                $this->file_sha = Utils::getFileSHA();
            }
        }

        if($this->settings->include_classes){
            $this->autoloadHandlers();
        }

        $this->logger->debug("Chosen mode is: ".$this->settings->mode);
    }

    public function stop(int $signo = null)
    {
        if(!$this->settings->wait_handlers || $this->settings->mode !== self::CLI || !$this->settings->async) exit;

        print("Stopping...".PHP_EOL);
        if($this->running){
            if($this->is_handling){
                print("Could not stop, Bot is handling updates".PHP_EOL);
                sleep(1);
            }
            else{
                $this->running = false;
                $pool = $this->getDispatcher()->getPool();
                $pool->checkChilds();
                if($pool->hasChilds() || $pool->hasQueue()){
                    print("Waiting for handlers to finish...".PHP_EOL);
                    $pool->wait();
                }
                exit;
            }
        }
    }

    protected function restartOnChanges(){
        if($this->settings->restart_on_changes){
            if($this->file_sha !== Utils::getFileSHA()){
                print(PHP_EOL."Restarting script...".PHP_EOL.PHP_EOL);
                @cli_set_process_title("NovaGram: died process ({$this->getUsername()})");
                $path = realpath($_SERVER['SCRIPT_FILENAME']);
                function_exists("pcntl_exec") ? pcntl_exec(PHP_BINARY, [$path]) : shell_exec("php $path");
                exit();
            }
        }
    }

    protected function processUpdates($offset = 0){
        $async = $this->settings->async;
        if($async){
            $this->getDispatcher()->resolveQueue();
            $pool = $this->getDispatcher()->getPool();
            $timeout = !$pool->hasQueue() ? self::TIMEOUT : 0;
        }
        else $timeout = self::TIMEOUT;
        $params = ['offset' => $offset, 'timeout' => $timeout, "allowed_updates" => $this->getDispatcher()->getAllowedUpdates()];
        $this->logger->debug('Processing Updates (async: '.(int) $async.')', $params);
        try{
            $updates = $this->getUpdates($params);
        }
        catch(BadGatewayException $e){
            $this->logger->critical("A BadGatewayException has occured while long polling, trying to reconnect...");
            sleep(1);
            return $offset;
        }
        $this->logger->debug('Processed Updates (async: '.(int) $async.')', $params);
        $this->restartOnChanges();
        foreach ($updates as $update) {
            $this->is_handling = true;
            $this->getDispatcher()->handleUpdate($update);
            $offset = $update->update_id+1;
        }
        $this->is_handling = false;
        return $offset;
    }

    protected static function showLicense(): void {
        if(!self::$shown_license){
            print(self::LICENSE.PHP_EOL);
            self::$shown_license = true;
        }
    }

    public function idle(){
        if(!$this->started){
            if($this->settings->mode === self::NONE){
                throw new Exception("Cannot idle, Bot mode is NONE.");
            }
            if(!$this->getDispatcher()->hasHandlers()){
                throw new Exception("No handler is found, but idle() method has been called");
            }
            if(!$this->getDispatcher()->hasErrorHandlers()){
                $this->logger->warning("Error handler is not set.");
            }

            $this->started = true;
            if($this->settings->mode === self::CLI){
                $this->logger->debug('Idling...');
                $webhook_info = $this->getWebhookInfo();
                if($webhook_info->url !== ""){ // there is a webhook set
                    $this->deleteWebhook();
                    $this->logger->warning("There was a set webhook. It has been deleted. (URL: {$webhook_info->url})");
                }
                if($this->settings->export_commands && !$this->settings->is_user){
                    $this->exportCommands();
                }
                $this->running = true;
                $this->settings->threshold ??= 10; // set 10 as default when using getUpdates
                @cli_set_process_title("NovaGram: main process ({$this->getUsername()})");
                self::showLicense();
                while ($this->running) {
                    $offset = $this->processUpdates($offset ?? 0);
                }
            }
            if($this->settings->mode === self::WEBHOOK){
                if(isset($this->update)){
                    $this->getDispatcher()->handleUpdate($this->update);
                }
            }
        }
    }

    private function methodHasParamater(string $method, string $parameter){
        return in_array($method, $this->getJSON()["require_params"][$parameter]);
    }

    private function normalizeRequest(string $method, array $data){
        foreach (array_keys($this->getJSON()['require_params']) as $param) {
            if($this->methodHasParamater($method, $param) && isset($this->settings->$param)){
                $data[$param] ??= $this->settings->$param;
            }
        }

        foreach ($this->getJSON()['require_json_encode'] as $key){
            if(isset($data[$key]) && is_array($data[$key])){
                $data[$key] = json_encode($data[$key]);
            }
        }
        return $data;
    }

    public function APICall(string $method, array $data = [], bool $payload = false, bool $is_debug = false, \Exception $previous_exception = null){
        $data = $this->normalizeRequest($method, $data);
        $this->logger->debug("APICall: $method", $data);

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

        $response = Utils::curl($this->endpoint.$method, $data);
        $decoded = json_decode($response, true);

        if(!is_array($decoded)){
            throw new Exception("API returned a non-valid JSON: ".$response);
        }

        $this->logger->debug("Response: ".$response);
        if($decoded['ok'] !== true){
            if($is_debug) throw TelegramException::create("[DURING DEBUG] $method", $decoded, $data, $previous_exception);
            $e = TelegramException::create($method, $decoded, $data);
            if($this->settings->debug_mode === "classic" && $this->settings->debug){
                #$this->sendMessage($this->settings->debug, "<pre>".$method.PHP_EOL.PHP_EOL.print_r($data, true).PHP_EOL.PHP_EOL.print_r($decoded, true)."</pre>", ["parse_mode" => "HTML"], false, true);
                $this->debug( (string) $e, $previous_exception);
            }
            if($e instanceof TooManyRequestsException && $e->response_parameters->retry_after <= ($this->settings->threshold ?? 0) ){
                $retry_after = $e->response_parameters->retry_after;
                $this->logger->info("[Floodwait] Waiting for $retry_after seconds (caused by $method)");
                sleep($retry_after);
                return $this->APICall(...func_get_args());
            }
            elseif($this->settings->exceptions) throw $e;
            else return (object) $decoded;
        }

        if(is_bool($decoded['result'])) return $decoded['result'];

        if($this->getMethodReturned($method)) return $this->JSONToTelegramObject($decoded['result'], $this->getMethodReturned($method));
        else return is_array($decoded['result']) ? (object) $decoded['result'] : $decoded['result'];
    }

    private function getMethodReturned(string $method){
        return $this->getJSON()['available_methods'][$method]['returns'] ?? false;
    }

    private function getObjectType(string $parameter_name, string $object_name = ""){
        if($object_name !== "") $object_name .= ".";
        return $this->getJSON()['available_types'][$object_name.$parameter_name] ?? false;
    }

    public function JSONToTelegramObject(array $json, string $parameter_name){
        if($this->getObjectType($parameter_name)) $parameter_name = $this->getObjectType($parameter_name);
        if(preg_match('/\[\w+\]/', $parameter_name) === 1) return $this->TelegramObjectArrayToObjectsList($json, $parameter_name);
        foreach($json as $key => &$value){
            if(is_array($value)){
                $ObjectType = $this->getObjectType($key, $parameter_name);
                if($ObjectType){
                    if($this->getObjectType($ObjectType)) $value = $this->TelegramObjectArrayToObjectsList($value, $ObjectType);
                    else $value = $this->JSONToTelegramObject($value, $ObjectType);
                }
                else $value = is_integer(array_keys($value)[0]) ? new ObjectsList($json) : (object) $value;
            }
        }
        return $this->createObject($parameter_name, $json);
    }

    private function TelegramObjectArrayToObjectsList(array $json, string $name){
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
                    if($this->getObjectType($childs_name)) $value = $this->TelegramObjectArrayToObjectsList($value, $childs_name);
                    //else $value = $this->createObject($childs_name, $value);
                    else $value = $this->JSONToTelegramObject($value, $childs_name);
                }
                else $value = $this->JSONToTelegramObject($value, $this->getObjectType($childs_name, $parent_name));

            }
        }
        return new ObjectsList($json);

    }

    public static function getUsernameDC(string $username){
        preg_match('/cdn(\d)/', Utils::curl("https://t.me/$username"), $matches);
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
                "text" => "<pre>".htmlspecialchars( is_string($value) ? $value : Utils::var_dump($value) )."</pre>",
                "parse_mode" => "HTML"
            ], false, true, $previous_exception);
        }
        else throw new Exception("debug chat id is not set");
    }

    public function getJSON(): array
    {
        return $this->json ??= json_decode(implode(file(__DIR__."/json.json")), true);
    }

    protected function getDispatcher(): Dispatcher
    {
        return $this->dispatcher ??= new Dispatcher($this, Utils::isCLI() && $this->settings->async, $this->settings->group_handlers, $this->settings->wait_handlers);
    }

    public function getDatabase(): Database
    {
        if(!isset($this->database)){
            throw new Exception("Bot instance has no linked Database");
        }
        return $this->database;
    }

    public function hasDatabase(): bool
    {
        return isset($this->database);
    }

    public function getUsername(): string{
        if(!isset($this->settings->username) && !Utils::isCLI()){
            $this->logger->warning("Bot username is not specified in Bot settings. When using command handlers on webhook it is recommended to pass username in settings, or a getMe call will be done on every update");
        }
        return $this->settings->username ??= $this->getMe()->username;
    }

    public function __destruct(){
        if($this->settings->mode !== self::NONE && !$this->started){
            $this->logger->debug("Triggered destructor");
            if($this->getDispatcher()->hasHandlers()){
                $this->settings->debug_mode = "new";

                if($this->settings->mode === self::CLI){
                    $this->logger->debug('Idling by destructor');
                    $this->logger->error('No call to Bot::idle() has been done, idling by destructor. NovaGram will not idle automatically anymore in v2.0');
                    $this->idle();
                }
                if($this->settings->mode === self::WEBHOOK){
                    $this->idle();
                }
            }
        }
    }

    public function __debugInfo() {
        $obj = get_object_vars($this);
        foreach(['json', 'settings', 'payloaded', 'raw_update'] as $key){
            unset($obj[$key]);
        }
        return $obj;
    }

    public function __serialize()
    {
        $obj = get_object_vars($this);
        foreach(['dispatcher', 'json'] as $key){
            unset($obj[$key]);
        }
        return $obj;
    }
}

?>
