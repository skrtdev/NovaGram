<?php
$baseMemory = memory_get_usage();
$array = [];

foreach (range(0, 100000) as $_) {
    $array[random_int(1111111, 9999999)] = (bool) random_int(0,1);
    #echo count($array). PHP_EOL;
}
echo count($array). PHP_EOL;
echo formatSizeUnits(memory_get_usage() - $baseMemory), PHP_EOL;
$array = [];
#exit;
require __DIR__ . '/../vendor/autoload.php';
require 'TelegramHandler.php';
require 'time.php';

use danog\Decoder\FileId;
use danog\Decoder\UniqueFileId;
use JetBrains\PhpStorm\Pure;
use skrtdev\NovaGram\Filter;
use skrtdev\NovaGram\{Bot,
    CommandScope,
    Database\PostgreSQLDatabase,
    Database\SQLiteDatabase,
    Time,
    BaseHandler,
    BaseCommandHandler,
    TracebackNormalizer};
use skrtdev\async\Pool;
use skrtdev\Telegram\{Chat, InlineQuery, Type, Update, Message, CallbackQuery, ChatMemberUpdated, User};
use skrtdev\NovaGram\Exception as NovaGramException;
use skrtdev\Prototypes\Prototypes;
use skrtdev\Telegram\Exception as TelegramException;
use skrtdev\Prototypes\Prototypeable;
$bench = new Time();

/*foreach (glob((require ('../vendor/composer/autoload_psr4.php'))['skrtdev\\Telegram\\'][0].'/*') as $path) {
    #require_once $path;
}*/

/*function rglob($pattern, $flags = 0) {
    $files = glob($pattern, $flags);
    foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
        $files = array_merge($files, rglob($dir.'/'.basename($pattern), $flags));
    }
    return $files;
}
*/
/*
foreach (require ('../vendor/composer/autoload_psr4.php') as $folders) {
    foreach ($folders as $folder) {
        var_dump($folder);
        foreach (glob("$folder/*.php") as $path) {
            require_once $path;
            var_dump($path);
        }
    }
}
*/

/*
$n = (2 - 4) + (8 + 16);

assert((2 - 4) + (8 + 16) === 2 - 4 + 8 + 16);
//assert((2 - 4) - (8 + 16) === 2 - 4 - 8 + 16);

$nn = 0;
for ($i=2; $i < 2**5; $i = $i*2) {
    if(is_float($i)){
        //break;
    }
    var_dump($i);
    var_dump($n - $i);
}

echo "here", PHP_EOL;

2+4;
2+4; 2-4; -2-4; -2+4;

2+4-8;
2+4+8; 2+4-8; 2-4+8; 2-4-8; -2+4+8; -2+4-8; -2-4+8; -2-4-8;

function get_potenze(int $n){
    for ($i=1; $i <= $n; $i++) {
        yield 2**$i;
    }
}

function get_segni(int $n, int $i){
    $ii = $i;
    $res = [];
    echo 'ae', PHP_EOL;
    var_dump($n);
    for ($i=0; $i < $ii; $i++) {
        var_dump($n.' >= '.(2**($ii-$i)));
        $res[] = $n >= 2**($ii-$i) ? '-' : '+';
        //$n -= $n > 2*$i;
    }
    return $res;
}

function detect(int $n, int $i){
    $asdone = $i;
    $sum = 0;
    for ($ii=1; $ii <= $i; $ii++) {
        $sum += 2**$ii;
    }
    //var_dump($sum);
    if($n === $sum){
        return "tutti and aeo";
    }
    else{
        $test = $sum;
        foreach (get_potenze($i) as $p) {
            var_dump($test - $p);
        }
        for ($i=0; $i <= $ii; $i++) {
            var_dump(math_eval("1+1+1+1+1"));
        }
        $segni = [];
        for($i=1; $i <= $asdone**2; $i++){
            $segni[] = get_segni($i, $asdone);
        }
        var_dump($segni);
    }
}

detect(2-4, 2);
//var_dump(detect(2+4+16+8, 4));

exit();
*/

function formatSizeUnits(int $bytes): string
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}

/*
class Filters{

    protected array $args;

    function __construct(...$args)
    {
        $this->args = $args;
    }

    public function getArgs(): array
    {
        return $this->args;
    }

    public static function TextMessage()
    {
        return function ($message) {
            return isset($message->text);
        };
    }

    public static function TextRegex(string $pattern)
    {
        return function ($message) use ($pattern) {
            return (self::TextMessage())($message) && preg_match($pattern, $message->text);
        };
    }

    public static function commands($commands = [])
    {
        if(is_string($commands)){
            $commands = [$commands];
        }

        return function ($message) use ($commands) {
            return (self::TextMessage())($message) && (self::TextRegex('/\/(?:'.implode('|', $commands).')/'))($message);
        };
    }
}

class Filters2 {

    protected array $args;

    function __construct(...$args)
    {
        $this->args = $args;
    }

    public function getArgs()
    {
        return $this->args;
    }

    public static function TextMessage()
    {
        return function ($message) {
            return isset($message->text);
        };
    }

    public static function TextRegex(string $pattern)
    {
        return function ($message) use ($pattern) {
            return (self::TextMessage())($message) && preg_match($pattern, $message->text);
        };
    }

    public static function commands($commands = [])
    {
        if(is_string($commands)){
            $commands = [$commands];
        }

        return function ($message) use ($commands) {
            return (self::TextMessage())($message) && (self::TextRegex('/\/(?:'.implode('|', $commands).')/'))($message);
        };
    }
}
*/

/*

Bot::addMethod("onMessage_", function (Filters $filters, Closure $handler) {
/*    $this->onUpdate(function (Update $update) use ($filters, $handler) {
        if(!isset($update->message)) return;
        foreach ($filters->getArgs() as $filter) {
            if(!$filter($update->message)) return;
        }
        $handler($update->message);
    });
    /
    $this->onMessage(function (Message $message) use ($filters, $handler) {
        foreach ($filters->getArgs() as $filter) {
            if(!$filter($message)) return;
        }
        $handler($message);
    });
});
*/
Bot::addMethod("onMessageFilter", function (Closure $filters, Closure $handler) {
    $this->onMessage(function (Message $message) use ($filters, $handler) {
        if($filters($message)){
            $handler($message);
        }
    });
});

$time = new Time;
#throw new Exception($bench());
#$bench = new Time();
class CustomSQLiteDatabase extends SQLiteDatabase
{
    protected static array $create_tables = [
        'CREATE TABLE IF NOT EXISTS {users_table} (
            user_id BIGINT(64) UNIQUE,
            username VARCHAR(64) NULL
        )',
        'CREATE TABLE IF NOT EXISTS {conversations_table} (
            chat_id BIGINT(64) NOT NULL,
            name VARCHAR(64) NOT NULL,
            value BLOB(4096) NOT NULL,
            is_permanent BOOL DEFAULT TRUE
        )'
    ];

    public function saveUser(User $user): void {
        $this->query("INSERT INTO {$this->table_names['users']}(user_id, username) VALUES (:user_id, :username)", [
            ':user_id' => $user->id,
            ':username' => $user->username ?? null,
        ]);
    }
}

$Bot = new Bot("722952667:AAGD_WqliHLMzWk3QPDkrpISKVD38sqHKPA", [
    "username" => "wrzybot",
    "restart_on_changes" => true,
    #"debug" => 634408248,
    #"debug" => 0,
    "workers" => 10,
    #"log_updates" => 634408248,
    #"bot_api_url" => "http://localhost:8000",
    #'bot_api_url' => 'https://ibotcorp.com:8081/',
    #"async" => false,
    #'force_async' => true,
    "command_prefixes" => ['/', '.'],
    #"logger" => Logger::DEBUG,
    #"group_handlers" => false,
    "threshold" => 1000,
    'include_classes' => false,
    #"wait_handlers" => true,
    'parse_mode' => 'HTML',
    /*"database" => [
        "driver" => "sqlite", // default to mysql
        "host" => "db.sqlite3", // default to localhost:3306
    ],*/
    #'database' => new SQLiteDatabase('db.sqlite3'),
    'database' => new CustomSQLiteDatabase('db.sqlite3', create_tables: false),
    #'database' => new PostgreSQLDatabase('localhost', 'novagramtesting', 'gaetano', ''),
    'use_preg_match_instead_of_preg_match_all' => true,
    //'skip_old_updates' => true
    #'export_commands' => false
    'disable_ip_check' => true
]);
#throw new \Exception((string) $bench());
#$Bot->debug($bench());$bench = new Time();

var_dump($time().'ms');
echo formatSizeUnits(memory_get_usage() - $baseMemory), PHP_EOL;
#var_dump($Bot instanceof Prototypeable);

/*
set_error_handler(function (int $errno, string $errstr, $errfile, $errline) use ($Bot) {
    // $errstr may need to be escaped:
    $errstr = htmlspecialchars($errstr);

    $str = "Error: $errstr in $errfile:$errline";
    $Bot->debug($str);

    return true;
});
*/

class Handler extends BaseHandler{
/*    public function onUpdate(Update $update)
    {
        $Bot = $this->Bot;
        #print("afammoc");

        if(isset($update->message)){ // update is a message
            $message = $update->message;
            $chat = $message->chat;

            #yield delay(1000);
            #print("there");
            #sleep(1);
            $message->reply("afammoc from class");
            print("afammoc\n");
            #yield delay(1000);
        }
    }
*/
    public function onEditedMessage(Message $message)
    {
        $message->reply("FAMMOC HAI MODIFIACATO");
    }

    public function onMessage(Message $message)
    {
        #$message->reply("afammoc from class ONMESSAGE AEEEEE");
    }
}
/*
class CommandHandler extends BaseCommandHandler{

    protected Bot $Bot;
    protected $commands = " start";
    protected string $description;


    public function handle(Message $message){
        $message->reply("COMMAND HANDLER");
    }

}
*/
#var_dump(Filters::TextMessage() | Filters::TextMessage());

$Bot->onMessageFilter(fn($message) => $message->text === "F", function (Message $message) {
    stop_handling();
    $inline[] = [ ["text" => "Annulla", "callback_data" => "home"] ];

    $message->reply("onMessageFilter F FOR YOU", reply_markup: ["inline_keyboard" => $inline]);
});

/*
$Bot->onMessage_(new Filters(Filters::TextMessage()), function (Message $message) {
    $message->reply("text message");
});

$Bot->onMessage_(new Filters(Filters::TextRegex('/ciao/')), function (Message $message) {
    $message->reply("ciao");
});


$Bot->onMessage_(new Filters(Filters::commands("start")), function (Message $message) {
    $message->reply($message->getHTMLText());
});

$Bot->onMessage_(new Filters(Filters::commands("dc")), function (Message $message) {
    $message->reply($message->from->getDC());
});
*/

$Bot->onTextMessage(function (Message $message) {
    #$message->reply("on text message handler");
});

$Bot->onText('ae',
    #[Filter(is_reply: false)]
    function (Message $message) {
    $message->reply("ae anche a te lol");
});

$Bot->onText('lol', function (Message $message) {
    $message->reply("lololololol");
});

$Bot->onText('/ciao (\w+)/', function (Message $message, array $matches) {
    $message->reply(print_r($matches, true));
});

$Bot->onCommand(['lol', 'lol2'], function (Message $message, array $matches) {
    $message->reply("lololololol ma come comando");
    $message->reply(print_r($matches, true));
});

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$Bot->onCommand('start', function (Message $message) use ($Bot) {
    #$message->reply(print_r($message, true));#
    $message->reply(print_r($message->from->getConversations(), true));
    #$message->chat->deleteAllConversations();
    $message->from->conversation(generateRandomString(), generateRandomString(), (bool) rand(0, 1));
    #$Bot->sendMessage(chat_id: $message->from->id, text: "Ciao kek");
    #$message->reply("ae comando start", text: "Ops sovrascritto");
    return;
    sleep(5);
    $message->reply("after 5");
});

$Bot->onCommand('photo', function (Message $message) use ($Bot) {
    $chat = $message->chat;
    $mex = $chat->sendPhoto('photo.png');
    #$chat->sendPhoto(new CurlFile('photo.png'));
});

$Bot->onCommand('propic', function (Message $message) use ($Bot) {
    $photos = $message->from->getProfilePhotos();
    #var_dump($photos);
    var_dump($photos->photos->{'0'});
    foreach ($photos->photos as $photo) {
        $message->chat->sendPhoto($photo[0]->file_id);
    }
});

$Bot->onCommand('stop', function (Message $message) use ($Bot) {
    $message->reply("Stopping...");
    sleep(1);
    posix_kill(posix_getppid(), SIGINT);
});

$Bot->onCommand('flood', function (Message $message) use ($Bot) {
    $mex = $message->reply("conto...");
    $pool = new Pool(30);
    $n = 100;
    for ($i=0; $i < $n; $i++) {
        $pool->parallel(fn() => $message->reply("aeoooo!")->delete() and sleep(2));
    }
    while(true){
        #$mex->editText($pool->getQueueLength().'\nUltimo aggiornamento: '.date('H:i:s'));
        #$message->reply($pool->getQueueLength());
        $pool->resolveQueue();
        $mex->reply("Messaggi inviati: ".($n - $pool->getQueueLength()).PHP_EOL.'Ultimo aggiornamento: '.date('H:i:s'));
        if($pool->getQueueLength() === 0){
            break;
        }
        sleep(1);
    }
    $message->reply($pool->getQueueLength());
});



$Bot->onCallbackQuery(
    function (CallbackQuery $callback_query) {
        $callback_query->answer($callback_query->from->getDC(), ["show_alert" => true]);
    }
);

#$Bot->onMyChatMember(#[Filter(is_reply: true)] fn() => true);

#$Bot->onCallbackData("home", fn($cb) => $cb->message->editText("WORKAAAA", reply_markup: ["inline_keyboard" => [[ ["text" => "aeoiry", "callback_data" => "home"] ]]]));
$Bot->onCallbackData("home", fn($cb) => $cb->message->editText("WORKAAAA", ["reply_markup" => ["inline_keyboard" => [[ ["text" => "aeoiry", "callback_data" => "home"] ]]]]));

$Bot->onNewChatMember(function(Chat $chat, User $user){
    $chat->sendMessage("Benvenuto {$user->getMention()}");
}, /*Bot::ALL*/);

$Bot->onNewChatMember(function(Chat $chat, User $user){
    $chat->sendMessage("Benvenuto caruso {$user->getMention()}");
}, /*Bot::USERS_ONLY*/);

$Bot->onNewChatMember(function(Chat $chat, User $user){
    $chat->sendMessage("Benvenuto botolo {$user->getMention()}");
}, /*Bot::BOTS_ONLY*/);

$Bot->onText('fold', fn($m) => $m->chat->leave());

$Bot->onNewGroup(function(Chat $chat, User $adder){
    $chat->sendMessage("Thanks {$adder->getMention()} for adding me to this group!");
});

Message::addMethod('ciao', fn() => "waglio");

/*
$Bot->onUpdate(function (Update $update) use ($Bot) {
    return;
    if(isset($update->message)){ // update is a message
        $message = $update->message;
        $chat = $message->chat;
        var_dump($message->ciao());
        $message->reply("from Update handler");
    }
});*/





# $Bot->handleClass(Handler::class);

/*
$v = 4 | 8;
var_dump($v);
exit;
*/
#$Bot->addCommandHandler(CommandHandler::class);
//$Bot->onUpdate(fn(Update $update) => var_dump($update));
$Bot->onCommand('kick', function (Message $message){
    $message->chat->banMember($message->from->id);
});

$Bot->onChatMember(function (ChatMemberUpdated $chat_member_updated){
    $chat = $chat_member_updated->chat;
    $from = $chat_member_updated->from;
    $new_chat_member = $chat_member_updated->new_chat_member;
    $user = $new_chat_member->user;
    #var_dump($chat_member_updated);
    if($chat->type === 'channel') return;
    $chat->sendMessage("{$from->getMention()} cazo fai con {$user->getMention()}");
});

#[Attribute(Attribute::TARGET_FUNCTION | Attribute::IS_REPEATABLE)]
class OwnFilter extends Filter{
    const ME = 634408248;

    public function __construct(
        protected ?bool $is_me = null,
        ...$args
    ){
        parent::__construct(...$args);
    }

    #[Pure]
    public function handle(Message|InlineQuery|CallbackQuery $object): bool
    {
        [,,, $user] = self::normalizeObject($object);
        return (!isset($this->is_me) || $this->is_me === ($user->id === self::ME)) && parent::handle($object);
    }


}

function a(int $n = 0){
    if($n > 20){
        global $Bot;
        $Bot->sendMessage(0, 0);
        throw new Exception();
    }
    else a(++$n);
}

Message::addMethod('asdasd', fn(...$args) => a(n: 0));

$Bot->onMessage(
    #[Filter(is_private: true, is_reply: true, is_photo: false)]
    //#[OwnFilter(is_me: true, is_reply: false, is_photo: false)]
    function (Message $message){
        $message->reply('filters are cool');
        #$message->asdasd([1, ['lol'] ,new stdClass(),5, false], asdone: false);
    }
);

$Bot->onCommand('bench', function(Message $message){
   global $bench;
   $t = new Time();
   $a = $message->reply("{$bench()}ms");
   $a->editText("$a->text, sent in {$t()}ms", true);
});

$Bot->onCommand([
        'levlamovunque',
        /*'levlamit' => new CommandScope(language_code: 'it', description: 'levlam italiano'),
        'levlamen' => new CommandScope(language_code: 'en'),*/
    ],
    //#[Filter(is_forwarded: false)]
    function(Message $message){
        $message->reply('levlam');
        $message->reply(['text' => 'levlam']);
        $message->reply(text: 'levlam');

        $user = $message->from;
        $user->sendMessage('levlam');
        $user->sendMessage(['text' => 'levlam']);
        $user->sendMessage(text: 'levlam');
        $user->sendMessage('levlam', ['reply_markup' => ['inline_keyboard' => [[button('ae', 'google.it', true)]]]], false);
        $user->sendMessage('*levlam*', 'markdown');
        #$message->reply(get_dc($message->from));
    },
    [new CommandScope('all_private_chats'), new CommandScope(chat_id: [-1001185261677, -1001483570860])],
    'levlam di un paese bella la descrizione'
);

$Bot->onInlineQuery(#[Filter(is_private: true)]
    function (InlineQuery $inlineQuery){
        var_dump($inlineQuery);
});

function find_chat_object(Type $object): ?Chat {
    foreach ($object as $item) {
        if($item instanceof Type){
            if($item instanceof Chat){
                return $item;
            }
            else{
                $found = find_chat_object($item);
                if(isset($found)){
                    return $found;
                }
            }
        }
    }
    return null;
}

$Bot->onUpdate(function(Update $update){
    #return;
    #var_dump(find_chat_object($update));
    #find_chat_object($update)->sendMessage('<pre>'.htmlspecialchars($update->toJSON()).'</pre>');
    #find_chat_object($update)->sendMessage('<pre>'.htmlspecialchars($update->toJSON()).'</pre>');
    #var_dump($update);
    #echo $update->toJSON(), PHP_EOL;
    #var_dump(json2_decode($update->toArray(), Update::class));
    #var_dump('inside update handler');
    #sleep(3);
    #throw new Exception();
});

function get_dc(User $user): ?int
{
    $profile_photos = $user->getProfilePhotos();
    var_dump($profile_photos->photos);
    var_dump($profile_photos->photos->getLast()->getLast()->file_id);
    $fileId = FileId::fromBotAPI($profile_photos->photos->getLast()->getLast()->file_id);

    $version = $fileId->getVersion(); // bot API file ID version, usually 4
    $subVersion = $fileId->getSubVersion(); // bot API file ID subversion, equivalent to a specific tdlib version

    return $dcId = $fileId->getDcId(); // On which datacenter is this file stored
}

$Bot->onCommand('grouptest', group: 12, handler: fn($a) => $a->reply('yesyes'));
$Bot->onCommand('grouptest', fn($a) => $a->reply('dovrebbe venire prima'));

$Bot->onText('crash', fn() => throw new Exception('aeaeae'));
/*
$Bot->addErrorHandler(function (Exception|Error|ValueError $e) {
    print($e.PHP_EOL);
    return;
    #print("Caught ".get_class($e)." exception from general handler".PHP_EOL);
    print($e.PHP_EOL);
    return print(TracebackNormalizer::getNormalizedExceptionString($e));
    #exit;
    $string_trace = $e->getTraceAsString();
    echo $string_trace, PHP_EOL;

    var_dump(traceAsString($backtrace) === $string_trace ? "waglio\n\n\nn\n\n\n" : "chchch\n\n\n");
    return var_dump(traceAsString($backtrace));
    return;
    var_dump($string_trace);
    foreach (Prototypes::$traces as $trace => $value) {
        $trace = json_decode($trace, true);
        var_dump($trace, $value);
        $from = "{$trace['file']}({$trace['line']}): {$trace['class']}{$trace['type']}{$trace['function']}";
        $to = "{$trace['file']}({$trace['line']}): {$trace['class']}{$trace['type']}$value";
        echo "{$trace['file']}({$trace['line']}): {$trace['class']}{$trace['type']}{$trace['function']}", PHP_EOL;
        $string_trace = str_replace($from, $to, $string_trace);
    }
    var_dump($string_trace);
    return;
    foreach ($e->getTrace() as $trace) {
        #var_dump(array_keys($trace));
        $item = $trace;
        if(!isset($item['file'])){
            var_dump($item);
            continue;
        }
        var_dump(Prototypes::$traces["{$item['file']}:{$item['line']}"] ?? null);
    }
});*/

/*$Bot->deleteMyCommands(scope: ['type'=> 'all_private_chats']);
$Bot->deleteMyCommands(scope: ['type'=> 'all_private_chats'], language_code: 'it');
$Bot->deleteMyCommands(language_code: 'it');
$Bot->deleteMyCommands(scope: ['type'=> 'all_private_chats'], language_code: 'en');
$Bot->deleteMyCommands(language_code: 'en');*/

#Bot::addMethod("onMessage_", fn() => true);
var_dump($time().'ms');
echo formatSizeUnits(memory_get_usage() - $baseMemory), PHP_EOL;
echo formatSizeUnits(memory_get_usage(true)), PHP_EOL;
#var_dump(get_included_files());
/*(function()
{
    $e = new \skrtdev\NovaGram\Exception();
    echo 'Fatal error: Uncaught ', $e, PHP_EOL;
})();
exit();
throw new \skrtdev\NovaGram\Exception();*/
#var_dump($Bot);
#exit();
#var_dump(serialize($Bot));

$Bot->start();
#echo "AFTER IDLE (LOL)";