<h1 align=center>
    <img src="https://i.imgur.com/KdoYAWu.png" width=300>
    <br><br>
    NovaGram
</h1>
<div align=center>

[![GitHub license](https://img.shields.io/github/license/skrtdev/NovaGram)](https://github.com/skrtdev/NovaGram/blob/master/LICENSE) [![GitHub stars](https://img.shields.io/github/stars/skrtdev/NovaGram)](https://github.com/skrtdev/NovaGram/stargazers) [![Version](https://poser.pugx.org/skrtdev/novagram/version)](https://github.com/skrtdev/NovaGram/releases)  [![Total Downloads](https://poser.pugx.org/skrtdev/novagram/downloads)](https://packagist.org/packages/skrtdev/novagram) [![Total Downloads](https://img.shields.io/static/v1?label=telegram&message=group&color=blue&logo=telegram)](https://t.me/joinchat/JdBNOEqGheC33G476FiB2g)

</div>

<p align="center">
<b><i>An elegant, Object-Oriented, reliable PHP Telegram Bot Library</i></b><br><br>
<a href="https://docs.novagram.ga">Full Documentation</a> •
<a href="https://t.me/joinchat/JdBNOEqGheC33G476FiB2g">Public support group</a><br>
<a href="#-examples">Examples</a> •
<a href="#-features">Features</a> •
<a href="#-installation">Installation</a>
</p>

> **🌟 v1.9 has been released:** check changelog [here](https://github.com/skrtdev/NovaGram/blob/master/CHANGELOG.md#v19---source-code)

## ⚙️ Examples
An example code of a simple bot.  
Works with both getUpdates and Webhooks
```php
use skrtdev\NovaGram\Bot;
use skrtdev\Telegram\Message;

$Bot = new Bot('YOUR_TOKEN');

$Bot->onCommand('start', function (Message $message) {
    $message->reply('Hey! Nice to meet you. Use /info to know more about me.');
});

$Bot->onCommand('info', function (Message $message) {
    $message->reply('Well, I\'m just an example, but you can learn more about NovaGram at docs.novagram.ga');
});

$Bot->start();
```

## 📎 Features

- ***Full***: All the Methods and Types implemented in *Bot Api 5.3* (support **local Bot Api** too)
- ***Fast***: Support for *JSON payload*, and *async handling of updates*
- ***Extendable***: With [Prototypes](https://docs.novagram.ga/prototypes.html), you can add your *custom functionalities*
- ***Easy***: *Exactly like original Bot Api*, with many methods simplified in a very nice way
- ***Ready***: You can *start creating your amazing bot right now*, thanks to many Built-in features, such as [Conversations](https://docs.novagram.ga/database.html), [Entities Parser](https://docs.novagram.ga/objects.html) and [getDC](https://docs.novagram.ga/docs.html#getUsernameDC)
- ***Secure***: When using Webhooks, there is a *Built-in Telegram IP Check*, that works with Cloudflare too!

### Why another PHP library?

I decided to build my own php library for telegram bot api because all the libraries i found on the web [made it difficult even to do the simplest things](docs/compare.md), such as a sendMessage.  
NovaGram is built in order to bring a lightweight alternative to make bots, so that it is simple for beginners, but powerful for who already knows how to implement it.

## ⬇️ Installation

### Installation via [Composer](https://getcomposer.org)

Install NovaGram via Composer
```bash
composer require skrtdev/novagram ^1.9
```

After Installation, include NovaGram with:
```php
require 'vendor/autoload.php';
```

### Installation via Phar

Include the `phar` file in your bot file:
```php
if (!file_exists('novagram.phar')) {
    copy('https://novagram.ga/phar', 'novagram.phar');
}
require_once 'novagram.phar';
```

More info in the [Documentation](https://docs.novagram.ga)  
