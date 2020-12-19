<?php

require __DIR__ . '/../vendor/autoload.php';
require 'TelegramHandler.php';

use skrtdev\NovaGram\Bot;
use skrtdev\NovaGram\BaseHandler;
use skrtdev\Telegram\{Update, Message, CallbackQuery};
use skrtdev\NovaGram\Exception as NovaGramException;
use skrtdev\Telegram\Exception as TelegramException;
use Monolog\Logger;
use Monolog\Handler\TelegramHandler;

class Filters{

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

function filters(...$args)
{
    return new Filters($args);
}

Bot::addMethod("onMessage_", function (Filters $filters, Closure $handler) {
/*    $this->onUpdate(function (Update $update) use ($filters, $handler) {
        if(!isset($update->message)) return;
        foreach ($filters->getArgs() as $filter) {
            if(!$filter($update->message)) return;
        }
        $handler($update->message);
    });
    */
    $this->onMessage(function (Message $message) use ($filters, $handler) {
        foreach ($filters->getArgs() as $filter) {
            if(!$filter($message)) return;
        }
        $handler($message);
    });
});

Bot::addMethod("onMessageFilter", function (Closure $filters, Closure $handler) {
    $this->onMessage(function (Message $message) use ($filters, $handler) {
        if($filters($message)){
            $handler($message);
        }
    });
});

$Bot = new Bot("722952667:AAE-N5BNWRdDlAZQuNzUsxc7HKuoYHkyphs", [
    "restart_on_changes" => true,
    "debug" => 634408248,
    #"bot_api_url" => "http://localhost:8081",
    #"async" => false
    "command_prefixes" => ['/', '.'],
    #"logger" => Logger::DEBUG,
    "group_handlers" => false,
    "threshold" => 820,
    #"wait_handlers" => true,
    "database" => [
        "driver" => "sqlite", // default to mysql
        "host" => "db.sqlite3", // default to localhost:3306
    ]
]);

set_error_handler(function (int $errno, string $errstr, $errfile, $errline) use ($Bot) {
    // $errstr may need to be escaped:
    $errstr = htmlspecialchars($errstr);

    $str = "Error: $errstr in $errfile:$errline";
    $Bot->debug($str);

    return true;
});

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

    public function onMessage(Message $message)
    {
        #$message->reply("afammoc from class ONMESSAGE AEEEEE");
    }
}

#var_dump(Filters::TextMessage() | Filters::TextMessage());

$Bot->onMessage_(new Filters(Filters::TextMessage()), function (Message $message) {
    $message->reply("text message");
});

$Bot->onMessage_(new Filters(Filters::TextRegex('/ciao/')), function (Message $message) {
    $message->reply("ciao");
});


$Bot->onMessage_(new Filters(Filters::commands("start")), function (Message $message) {
    #$message->reply("start!");
});

$Bot->onMessage_(new Filters(Filters::commands("dc")), function (Message $message) {
    $message->reply($message->from->getDC());
});

$Bot->onTextMessage(function (Message $message) {
    $message->reply("on text message handler");
});

$Bot->onText('ae', function (Message $message) {
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
    #$message->reply(print_r($message, true));
    #$message->reply(print_r($message->from->getConversations(), true));
    #$message->from->conversation(generateRandomString(), generateRandomString(), false);
    $Bot->sendMessage(chat_id: $message->from->id, text: "Ciao kek");
    $message->reply("ae comando start", text: "Ops sovrascritto");
    sleep(10);
    $message->reply("after 10");
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

$Bot->onMessageFilter(fn($message) => $message->text === "F", function (Message $message) {
    $inline[] = [ ["text" => "Annulla", "callback_data" => "home"] ];

    $message->reply("onMessageFilter F FOR YOU", reply_markup: ["inline_keyboard" => $inline]);
});

$Bot->onCallbackQuery(function (CallbackQuery $callback_query) {
    $callback_query->answer($callback_query->from->getDC(), ["show_alert" => true]);
});

/*
$Bot->onUpdate(function (Update $update) use ($Bot) {

    if(isset($update->message)){ // update is a message
        $message = $update->message;
        $chat = $message->chat;

        $message->reply("from Update handler");
    }
});
*/


$Bot->setErrorHandler(function (Throwable $e) {
    #print("Caught ".get_class($e)." exception from general handler".PHP_EOL);
    print($e.PHP_EOL);
    #exit;
});

$Bot->handleClass(Handler::class);

#$Bot->idle();

?>
