# NovaGram
[![GitHub license](https://img.shields.io/github/license/skrtdev/NovaGram)](https://github.com/skrtdev/NovaGram/blob/master/LICENSE) [![GitHub stars](https://img.shields.io/github/stars/skrtdev/NovaGram)](https://github.com/skrtdev/NovaGram/stargazers) [![Version](https://poser.pugx.org/skrtdev/novagram/version)](https://github.com/skrtdev/NovaGram/releases) [![Latest Unstable Version](https://poser.pugx.org/skrtdev/novagram/v/unstable)](https://github.com/skrtdev/NovaGram/tree/beta) [![Total Downloads](https://poser.pugx.org/skrtdev/novagram/downloads)](https://packagist.org/packages/skrtdev/novagram)


An elegant, Object-Oriented, reliable PHP Telegram Bot Interface

**If you wanna test async getUpdates [check out beta branch](https://github.com/skrtdev/NovaGram/tree/beta)**

## Features

- All the Methods and Types implemented in Bot Api as of September 2020.
- Typed Properties for each Object (with description too)
- Exactly like Bot Api (so you don't really need documentation)
- [JSON Payload](https://docs.novagram.ga/construct.html#json-payload) implementation, for a faster Bot.
- Auto JSON-Encode in parameters that require it (when passing an array)
- [Object Methods](https://docs.novagram.ga/objects.html#objects-methods) for a smarter code (and a nice syntax)
- [JSON based](https://github.com/skrtdev/NovaGram/blob/master/src/novagram/json.json), so all methods and types are dinamically created.
- Native Debug, so you will be able to fix bugs immediately.
- Telegram IP check, in order to protect from Fake Update attacks. (with Cloudflare too!)
- Optional Telegram Exceptions, for handling Telegram API Errors as you like.
- Native Telegram Entities Parser. (Message::getHTMLText() and Message::getMarkdownText())
- Global Parse Mode, so you won't need to specify it in each method
- Global disable_web_page_preview, so you won't need to specify it in each method
- Global disable_notification, so you won't need to specify it in each method
- Ability to [retrieve DC](https://docs.novagram.ga/docs.html#getUsernameDC) of Users that has an Username
- Usable with Composer, but also in Hosting Panels that doesn't provide it, with PHPEasyGit

## Being implemented

- Database
- Conversations
- Message Entities -> Markdown (Message::getMarkdownText())

## Upcoming Features

- Markdown Entities Parser
- Database
- Conversations (full getters)
- TTL in Conversations
- Long Polling (async) - [check out beta branch](https://github.com/skrtdev/NovaGram/tree/beta)

### Installation via [Composer](https://getcomposer.org)
If Composer is installed globally:
```
composer require skrtdev/novagram
```

If Composer is installed in the current directory:
```
php composer.phar require skrtdev/novagram
```

After Installation, include NovaGram with:
```php
require __DIR__ . '/vendor/autoload.php';
```

### Example
An example code of a simple bot that just forwards back what you send.

```php
require __DIR__ . '/vendor/autoload.php';
use skrtdev\NovaGram\Bot;
$Bot = new Bot("YOUR_TOKEN");

$update = $Bot->update;
$message = $update->message;
$chat = $message->chat;
$user = $message->from;

$message->forward(); // forward() with no parameters will forward the Message back to the sender
```

More info in the [Documentation](https://docs.novagram.ga)  
Public support group at [https://t.me/joinchat/JdBNOEqGheC33G476FiB2g](https://t.me/joinchat/JdBNOEqGheC33G476FiB2g)
