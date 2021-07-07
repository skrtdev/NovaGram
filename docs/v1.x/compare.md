# A simple sendMessage script

Here you can find a simple sendMessage script, written in the first 7 libraries suggested by Telegram Site.  
I think a simple script like this should not exceed 5 lines of code, but maybe I'm wrong.

## tg-bot-api/bot-api-base

From an [example](https://github.com/tg-bot-api/bot-api-base):  
```php
$botKey = '<bot key>';

$requestFactory = new Http\Factory\Guzzle\RequestFactory();
$streamFactory = new Http\Factory\Guzzle\StreamFactory();
$client = new Http\Adapter\Guzzle6\Client();

$apiClient = new \TgBotApi\BotApiBase\ApiClient($requestFactory, $streamFactory, $client);
$bot = new \TgBotApi\BotApiBase\BotApi($botKey, $apiClient, new \TgBotApi\BotApiBase\BotApiNormalizer());

$userId = '<user id>';

$bot->send(\TgBotApi\BotApiBase\Method\SendMessageMethod::create($userId, 'Hi'));
```
Lines count: 8  
Characters count: 491  

## unreal4u/telegram-api

From an [example](https://github.com/unreal4u/telegram-api):  
```php
use \unreal4u\TelegramAPI\HttpClientRequestHandler;
use \unreal4u\TelegramAPI\TgLog;
use \unreal4u\TelegramAPI\Telegram\Methods\SendMessage;

$loop = \React\EventLoop\Factory::create();
$handler = new HttpClientRequestHandler($loop);
$tgLog = new TgLog(BOT_TOKEN, $handler);

$sendMessage = new SendMessage();
$sendMessage->chat_id = A_USER_CHAT_ID;
$sendMessage->text = 'Hello world!';

$tgLog->performApiRequest($sendMessage);
$loop->run();
```
Lines count: 11  
Characters count: 442  

## irazasyed/telegram-bot-sdk

From an [example](https://github.com/irazasyed/telegram-bot-sdk):  
```php
use Telegram\Bot\Api;

$telegram = new Api('BOT TOKEN');

$response = $telegram->sendMessage([
  'chat_id' => 'CHAT_ID',
  'text' => 'Hello World'
]);
```
Lines count: 6  
Characters count: 150  

## westacks/telebot

From an [example](https://github.com/westacks/telebot):  
```php
use WeStacks\TeleBot\TeleBot;
$bot = new TeleBot('<your bot token>');

$message = $bot->sendMessage([
    'chat_id' => 1234567890,
    'text' => 'Test message',
]);
```
Lines count: 6  
Characters count: 164  

## skrtdev/NovaGram

From an [example](https://github.com/skrtdev/NovaGram):  
```php
use skrtdev\NovaGram\Bot;

$Bot = new Bot(YOUR_TOKEN);

$Bot->sendMessage(1234567890, 'Test message');
```
Lines count: 3  
Characters count: 102  

## formapro/telegram-bot-php

From an [example](https://github.com/formapro/telegram-bot-php):  
```php
use Formapro\TelegramBot\Bot;
use Formapro\TelegramBot\SendMessage;

$bot = new Bot('telegramToken');
$bot->sendMessage(new SendMessage(
    1234567890,
    'Hi there! What can I do?'
));
```
Lines count: 7  
Characters count: 187  
