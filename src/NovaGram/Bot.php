<?php declare(strict_types=1);

namespace skrtdev\NovaGram;

use CURLFile;
use danog\Decoder\FileId;
use Monolog\Logger;
use skrtdev\NovaGram\Database\DatabaseInterface;
use skrtdev\Prototypes\Prototypeable;
use Monolog\Handler\{StreamHandler, ErrorLogHandler};

use skrtdev\Telegram\{Message,
    Type,
    Update,
    ObjectsList,
    Exception as TelegramException,
    BadGatewayException,
    TooManyRequestsException,
    ConflictException};

use Throwable;
use stdClass;

class Bot {

    use Methods;
    use HandlersTrait;
    use Prototypeable;

    const LICENSE = 'NovaGram - An Object-Oriented PHP library for Telegram Bots'.PHP_EOL.'Copyright (c) 2020-2021 Gaetano Sutera <https://github.com/skrtdev>'.PHP_EOL.'Licensed under the terms of the MIT License';
    const NONE    = 0;
    const WEBHOOK = 1;
    const CLI     = 2;
    const TIMEOUT = 300;

    const COMMAND_PREFIX = '/';

    const USERS_ONLY = 0;
    const BOTS_ONLY = 1;
    const ALL = 2;

    protected string $token;
    public stdClass $settings;
    private static array $json;
    private bool $payloaded = false;

    public ?Update $update = null; // read-only
    public ?array $raw_update = null; // read-only
    public int $id; // read-only
    private string $username; // read-only
    protected ?DatabaseInterface $database = null; // read-only
    protected string $endpoint;

    private array $allowed_updates;
    private bool $started = false;
    private bool $running = false;
    private static bool $shown_license = false;
    private bool $is_handling = false;
    private ?string $files_hash = null;

    public Logger $logger;
    private Dispatcher $dispatcher;

    /**
     * @throws Exception
     */
    public function __construct(string $token, array $settings = [], ...$kwargs) {

        $this->initializeToken($token);

        $this->settings = self::normalizeSettings($settings + $kwargs);

        $this->initializeLogger();
        $this->initializeEndpoint();

        $this->processSettings();
    }

    /**
     * @throws Exception
     */
    protected function initializeToken(string $token): void
    {
        if(!Utils::isTokenValid($token)){
            throw new Exception("Not a valid Telegram Bot Token provided ($token)");
        }
        $this->token = trim($token);
        $this->id = Utils::getIDByToken($token);
    }

    protected function initializeEndpoint(): void
    {
        $this->endpoint = trim($this->settings->bot_api_url, '/')."/bot$this->token/";
    }

    protected function initializeLogger()
    {
        $this->logger = $logger = new Logger('NovaGram');

        if(Utils::isCLI()) $logger->pushHandler(new StreamHandler(STDERR, $this->settings->logger));
        else $logger->pushHandler(new ErrorLogHandler(ErrorLogHandler::OPERATING_SYSTEM, $this->settings->logger));
        if(isset($this->settings->debug) && isset($this->token)){
            $logger->pushHandler(new TelegramLogger($this->token, $this->settings->debug, Logger::WARNING));
        }
        $logger->debug('Logger automatically replaced by a default one');
    }

    /**
     * @param array $settings
     * @return stdClass
     * @throws Exception
     */
    protected static function normalizeSettings(array $settings): stdClass
    {
        $settings_array = [
            'mode' => Utils::isCLI() ? self::CLI : self::WEBHOOK,
            'username' => null,
            'json_payload' => true,
            'log_updates' => null,
            'debug' => null,
            'disable_webhook' => false,
            'disable_ip_check' => false,
            'exceptions' => true,
            'async' => extension_loaded('pcntl'),
            'force_async' => false,
            'restart_on_changes' => false,
            'logger' => Logger::INFO,
            'bot_api_url' => 'https://api.telegram.org',
            'command_prefixes' => [self::COMMAND_PREFIX],
            'workers' => null,
            'group_handlers' => true,
            'wait_handlers' => false,
            'skip_old_updates' => false,
            'threshold' => Utils::isCLI() ? 10 : 0, // 10 is default when using getUpdates
            'export_commands' => true,
            'include_classes' => Utils::isCLI(),
            'database' => null,
            'parse_mode' => null,
            'disable_web_page_preview' => null,
            'disable_notification' => null,
            'disable_auto_webhook_set' => false,
            'debug_mode' => 'classic', // BC
        ];

        $settings += $settings_array;
        $settings = (object) $settings;

        $options = getopt('', ['restart', 'async:', 'skip', 'logger:']);
        if(isset($options['async'])) $settings->async = (bool) $options['async'];
        if(isset($options['restart'])) $settings->restart_on_changes = true;
        if(isset($options['skip'])) $settings->skip_old_updates = true;
        if(isset($options['logger'])) $settings->logger = (int) $options['logger'];

        foreach ($settings->command_prefixes as &$prefix){
            $prefix = preg_quote($prefix, '/');
        }

        if($settings->skip_old_updates && $settings->restart_on_changes){
            throw new Exception('Cannot use skip_old_updates and restart_on_changes simultaneously');
        }

        $settings->async = $settings->async && extension_loaded('pcntl');

        return $settings;
    }

    /**
     * @throws Exception
     */
    protected function processSettings(): void
    {
        $database = $this->settings->database;
        if(isset($database)){
            if(is_array($database)){
                $this->database = Utils::ArrayToDatabaseInterface($database);
                Utils::trigger_error('Using database array, use instance of '.DatabaseInterface::class.' instead',E_USER_DEPRECATED);
            }
            elseif($database instanceof DatabaseInterface){
                $this->database = $database;
            }
            else{
                throw new Exception('Bot database parameter must be an instance of '.DatabaseInterface::class.', '.get_debug_type($database).' passed');
            }
            $this->database->bind($this);
        }


        if($this->settings->mode === self::WEBHOOK){
            if((!$this->settings->disable_ip_check && !Utils::isTelegram()) || empty(file_get_contents('php://input'))){
                if(!$this->settings->disable_auto_webhook_set && !$this->hasWebhook()){
                    $this->setWebhook($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], ['allowed_updates' => Dispatcher::ALL_UPDATES]);
                    exit('Webhook has been set, enjoy your bot');
                }
                http_response_code(403);
                exit('Access Denied - Telegram IP Protection by NovaGram.ga');
            }

            $this->raw_update = json_decode(file_get_contents("php://input"), true);
            $this->update = new Update($this->raw_update, $this);
        }
        else{
            $this->settings->json_payload = false;
        }

        if(isset($this->settings->debug)){
            $this->addErrorHandler(function (Throwable $e) {
                $e_string = TracebackNormalizer::getNormalizedExceptionString($e);
                try {
                    $this->debug($e_string);
                }
                catch(Throwable $e2){
                    $e2_string = TracebackNormalizer::getNormalizedExceptionString($e2);
                    if(Utils::isCLI()){
                        $this->logger->critical('An Exception has occurred: '.get_class($e).'. Full exception has been printed to stdout.');
                        echo $e_string, PHP_EOL;
                        $this->logger->critical('An Exception has been thrown while sending debug for the above '.get_class($e).' exception: '.get_class($e2).'. Full exception has been printed to stdout.');
                        echo $e2_string, PHP_EOL;
                    }
                    else{
                        $this->logger->critical('An Exception has been thrown and debug could not be sent: '.get_class($e));
                        throw $e;
                    }
                }
            });
        }
        if(isset($this->settings->log_updates)){
            $this->onUpdate(function (Update $update){
                $this->sendMessage($this->settings->log_updates, "<pre>".Utils::htmlspecialchars($update->toJSON())."</pre>", ["parse_mode" => "HTML"]);
            });
        }

        if($this->settings->mode === self::CLI){
            if($this->settings->wait_handlers){
                pcntl_async_signals(true);
                pcntl_signal(SIGINT, [$this, 'stop']);
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

        echo 'Stopping...', PHP_EOL;
        if($this->running){
            if($this->is_handling){
                echo 'Could not stop, Bot is handling updates', PHP_EOL;
                sleep(1);
            }
            else{
                $this->running = false;
                $pool = $this->getDispatcher()->getPool();
                if($pool->hasChilds() || $pool->hasQueue()){
                    echo 'Waiting for handlers to finish...', PHP_EOL;
                    $pool->wait();
                }
                exit;
            }
        }
    }

    protected function restartOnChanges(){
        if($this->settings->restart_on_changes){
            $this->files_hash ??= Utils::getFilesHash();
            if($this->files_hash !== Utils::getFilesHash()){
                echo PHP_EOL, 'Restarting script...', PHP_EOL, PHP_EOL;
                if(function_exists("pcntl_exec") && !isset(getopt('', ['dev'])['dev'])){
                    pcntl_exec(PHP_BINARY, $GLOBALS['argv']);
                }
                else{
                    @cli_set_process_title("NovaGram: died process ({$this->getUsername()})");
                    $cmd = escapeshellcmd(PHP_BINARY.' '.implode(' ', $GLOBALS['argv']));
                    system($cmd);
                    for ($i = 0; $i < 100; $i++){
                        $this->logger->error('Bot crashed, trying to restart');
                        system($cmd);
                        sleep(2);
                    }
                }
                $this->logger->critical('Bot crashed 100 times, stopped');
                exit();
            }
        }
    }

    protected function getAllowedUpdates(): array{
        return $this->allowed_updates ??= $this->getDispatcher()->getAllowedUpdates();
    }

    protected function processUpdates($offset = 0){
        $async = $this->settings->async;
        if($async && $this->getDispatcher()->getPool()->hasQueue()){
            $this->logger->info('Resolving queue before processing other updates');
            $this->getDispatcher()->getPool()->waitQueue();
            $this->logger->info('Queue resolved');
        }
        $params = ['offset' => $offset, 'timeout' => self::TIMEOUT, 'allowed_updates' => $this->getAllowedUpdates()];
        $this->logger->debug('Processing Updates (async: '.(int) $async.')', $params);
        try{
            $updates = $this->getUpdates($params);
            global $bench;
            #$bench = new Time();
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
            #$bench = new Time();
            $this->getDispatcher()->handleUpdate($update, count($updates) === 1 && !$this->settings->force_async);
            $offset = $update->update_id+1;
        }
        $this->is_handling = false;
        return $offset;
    }

    protected static function showLicense(): void
    {
        if(!self::$shown_license){
            echo self::LICENSE, PHP_EOL;
            self::$shown_license = true;
        }
    }

    /**
     * @throws Exception
     */
    public function start(){
        if(!$this->started){
            if($this->settings->mode === self::NONE){
                throw new Exception("Cannot start, Bot mode is NONE.");
            }
            if(!$this->getDispatcher()->hasHandlers()){
                throw new Exception("No handler is found, but start() method has been called");
            }
            else $this->settings->debug_mode = "new";
            if(!$this->getDispatcher()->hasErrorHandlers()){
                $this->logger->warning("Error handler is not set. Check docs at https://docs.novagram.ga/errors_handling.html");
            }
            $this->getDispatcher()->initialize();
            $this->started = true;
            if($this->settings->mode === self::CLI){
                $this->logger->debug('Starting...');
                $webhook_info = $this->getWebhookInfo();
                if(!empty($webhook_info->url)){ // there is a webhook set
                    $this->deleteWebhook();
                    $this->logger->warning("There was a set webhook. It has been deleted. (URL: $webhook_info->url)");
                }
                if($this->settings->export_commands && (!empty($this->commands) || !empty($this->scoped_commands))){
                    if($this->settings->async && !empty($this->scoped_commands)){
                        $this->getDispatcher()->getPool()->parallel([$this, 'exportCommands']);
                        if(isset($this->database)) $this->database->reset();
                    }
                    else $this->exportCommands();
                }
                $this->running = true;
                @cli_set_process_title("NovaGram: main process ({$this->getUsername()})");
                $offset = $this->settings->skip_old_updates ? $this->getLastUpdateId() : 0;
                self::showLicense();
                while ($this->running) {
                    try{
                        $offset = $this->processUpdates($offset);
                    }
                    catch(Throwable $e){
                        if($e instanceof ConflictException){
                            throw $e;
                        }
                        elseif($e instanceof CurlException || $e instanceof TelegramException){
                            $string = 'An Exception has been thrown inside internal update handling: '.get_class($e).'. Full exception has been printed to stdout.'.PHP_EOL.'Telegram may be having internal problems.';
                        }
                        else{
                            $string = 'An Exception has been thrown inside internal update handling: '.get_class($e).'. Full exception has been printed to stdout.'.PHP_EOL.'You may need to report issue.';
                        }
                        $this->logger->critical($string);
                        echo TracebackNormalizer::getNormalizedExceptionString($e), PHP_EOL;
                        $offset = $this->getLastUpdateId();
                    }
                }
            }
            if($this->settings->mode === self::WEBHOOK){
                if(isset($this->update)){
                    $this->getDispatcher()->handleUpdate($this->update);
                }
            }
        }
    }

    protected function getLastUpdateId(): int{
        $updates = $this->getUpdates(['offset' => -1]);
        $update = $updates->getLast();
        if(isset($update)){
            return $update->update_id + 1;
        }
        return 0;
    }

    protected function hasWebhook(): bool
    {
        return !empty($this->getWebhookInfo()->url);
    }

    private function normalizeRequest(string $method, array $data): array
    {
        if(isset($this->settings->parse_mode) && in_array($method, ['sendMessage', 'copyMessage', 'sendPhoto', 'sendAudio', 'sendDocument', 'sendVideo', 'sendAnimation', 'sendVoice', 'editMessageText', 'editMessageCaption'])){
            $data['parse_mode'] ??= $this->settings->parse_mode;
        }
        if(isset($this->settings->disable_web_page_preview) && in_array($method, ['sendMessage', 'editMessageText'])){
            $data['disable_web_page_preview'] ??= $this->settings->disable_web_page_preview;
        }
        if(isset($this->settings->disable_notification) && in_array($method, ['sendMessage', 'forwardMessage', 'copyMessage', 'sendPhoto', 'sendAudio', 'sendDocument', 'sendVideo', 'sendAnimation', 'sendVoice', 'sendVideoNote', 'sendMediaGroup', 'sendLocation', 'sendVenue', 'sendContact', 'sendPoll', 'sendDice', 'pinChatMessage', 'sendSticker', 'sendInvoice', 'sendGame'])){
            $data['disable_notification'] ??= $this->settings->disable_notification;
        }
        if(isset($this->settings->allow_sending_without_reply) && in_array($method, ['sendMessage', 'copyMessage', 'sendPhoto', 'sendAudio', 'sendDocument', 'sendVideo', 'sendAnimation', 'sendVoice', 'sendVideoNote', 'sendMediaGroup', 'sendLocation', 'sendVenue', 'sendContact', 'sendPoll', 'sendDice', 'sendSticker', 'sendInvoice', 'sendGame'])){
            $data['allow_sending_without_reply'] ??= $this->settings->allow_sending_without_reply;
        }
        if(isset($this->settings->only_if_banned) && $method === 'unbanChatMember'){
            $data['only_if_banned'] ??= $this->settings->only_if_banned;
        }

        foreach ($data as $key => &$value){
            if(is_array($value)){
                $value = json_encode($value);
            }
            elseif(is_string($value) && in_array($key, ['photo', 'audio', 'thumb', 'document', 'video', 'animation', 'voice', 'video_note', 'sticker', 'png_sticker', 'tgs_sticker'])){
                if(file_exists($value)){
                    $value = new CURLFile($value);
                }
            }
        }
        return $data;
    }

    /**
     * @throws CurlException
     * @throws Exception
     * @throws TelegramException
     */
    public function APICall(string $method, array $data = [], ?string $class_name = null, bool $payload = false, bool $is_debug = false){
        $data = $this->normalizeRequest($method, $data);
        $this->logger->debug("APICall: $method", $data);

        if($this->settings->json_payload && $payload && !$this->payloaded){
            $this->payloaded = true;
            ob_clean();
            header('Content-Type: application/json');
            echo json_encode($data + ['method' => $method]);
            return null;
        }

        $response = Utils::curl($this->endpoint.$method, $data);
        $decoded = json_decode($response, true);

        if(!is_array($decoded)){
            throw new Exception("API returned a non-valid JSON: ".$response);
        }

        $this->logger->debug("Response: ".$response);
        if($decoded['ok'] !== true){
            if($is_debug){
                $decoded['description'] = 'An error occurred while sending debug: '.$decoded['description'];
                throw TelegramException::create("[DURING DEBUG] $method", $decoded, $data);
            }
            $e = TelegramException::create($method, $decoded, $data);
            if($this->settings->debug_mode === "classic" && isset($this->settings->debug)){
                $this->debug(TracebackNormalizer::getNormalizedExceptionString($e));
            }
            if($e instanceof TooManyRequestsException && $e->response_parameters->retry_after <= ($this->settings->threshold) ){
                $retry_after = $e->response_parameters->retry_after;
                $this->logger->info("[Floodwait] Waiting for $retry_after seconds (caused by $method)");
                sleep($retry_after);
                return $this->APICall(...func_get_args());
            }
            elseif($this->settings->exceptions) throw $e;
            else return (object) $decoded;
        }

        if(!is_array($decoded['result'])) {
            return $decoded['result'];
        }
        if (isset($class_name)) {
            return $this->createObject($decoded['result'], $class_name);
        }
        return (object) $decoded['result'];
    }

    /**
     * @param array $json
     * @param string $parameter_name
     * @return Type|ObjectsList
     */
    public function createObject(array $json, string $parameter_name): object
    {
        return is_list($json) ? new ObjectsList(iterate($json, fn($item) => new $parameter_name($item, $this))) : new $parameter_name($json, $this);
    }


    public function getUserDC(int $user_id): ?int
    {
        if(!class_exists('\danog\Decoder\FileId')){
            throw new Exception('Install tg-file-decoder with `composer require danog/tg-file-decoder` in order to use Bot::getUserDC');
        }
        $chat = $this->getChat($user_id);
        if(!isset($chat->photo)) return null;
        $file_id = $chat->photo->small_file_id;
        return FileId::fromBotAPI($file_id)->getDcId();
    }

    public static function getUsernameDC(string $username): ?int
    {
        preg_match('/cdn(\d)/', Utils::curl("https://t.me/$username"), $matches);
        return isset($matches[1]) ? (int) $matches[1] : null;
    }

    public function debug($value){
        if(isset($this->settings->debug)){
            return $this->APICall('sendMessage', [
                'chat_id' => $this->settings->debug,
                'text' => '<pre>' . htmlspecialchars(is_string($value) ? $value : Utils::var_dump($value)) . '</pre>',
                'parse_mode' => 'HTML'
            ], Message::class, false, true);
        }
        else throw new Exception("debug chat id is not set");
    }

    protected function getDispatcher(): Dispatcher
    {
        return $this->dispatcher ??= new Dispatcher($this, Utils::isCLI() && $this->settings->async, $this->settings->group_handlers, $this->settings->wait_handlers, $this->settings->workers);
    }

    public function getDatabase(): DatabaseInterface
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

    public function getUsername(): string
    {
        return $this->settings->username ??= $this->getMe()->username;
    }

    public function __destruct(){
        if(!$this->started && $this->getDispatcher()->hasHandlers()){
            if($this->settings->mode === self::WEBHOOK){
                $this->start();
            }
            else{
                $this->logger->error('Add `$Bot->start();` at the end of your file in order to make it work.');
            }
        }
    }

    public function __debugInfo() {
        $obj = get_object_vars($this);
        foreach(['settings', 'payloaded', 'raw_update', 'logger', 'commands', 'scoped_commands'] as $key){
            unset($obj[$key]);
        }
        return $obj;
    }

    public function __serialize()
    {
        $obj = get_object_vars($this);
        foreach(['dispatcher', 'commands', 'scoped_commands', 'logger'] as $key){
            unset($obj[$key]);
        }
        return $obj;
    }

    /**
     * @param Logger $logger
     * @return self
     */
    public function setLogger(Logger $logger): self
    {
        $this->logger = $logger;
        return $this;
    }
}

