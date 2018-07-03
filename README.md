Notifications via Telegram-Bot
=

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
composer require mirkhamidov/yii2-telegram-notifications "dev-master"
```




Configure
-----
add this lines to your project config file

```php
'components' => [
    ...,
    'telegram' => [
        'class' => \mirkhamidov\TelegramNotifications::class,
        'token' => ***', // Token of your bot
        'chat' => ***, // Notifications chat id
        'extraTitle' => "⚠️⚠️⚠️ Some extra title added to message⚠️⚠️⚠️\n", // optional
        'proxy' => 'socks5://LOGIN:PASS@PROXY_ADDRESS:PROXY_PORT', // optional, if needed to use proxy, like in Russia
    ],
],

```



# HOW

## How to find out my user`s Id ot chat id?

* send message to the bot
* Look at last updates at `https://api.telegram.org/bot{BOT_TOKEN}/getUpdates`
* {BOT_TOKEN} - replace with your bot token
