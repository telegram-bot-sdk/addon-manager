# Addon Manager for Telegram Bot SDK 

<p align="center">
<a href="https://phpchat.co"><img src="https://img.shields.io/badge/Slack-PHP%20Chat-5c6aaa.svg?logo=slack&labelColor=4A154B&style=for-the-badge" alt="Join PHP Chat"/></a>
<a href="https://t.me/PHPChatCo"><img src="https://img.shields.io/badge/Chat-on%20Telegram-2CA5E0.svg?logo=telegram&style=for-the-badge" alt="Chat on Telegram"/></a>
<a href="https://github.com/telegram-bot-sdk/addon-manager/actions"><img src="https://img.shields.io/github/workflow/status/telegram-bot-sdk/addon-manager/CI.svg?style=for-the-badge" alt="Build Status"/></a>
<a href="https://github.com/telegram-bot-sdk/addon-manager/releases"><img src="https://img.shields.io/github/release/telegram-bot-sdk/addon-manager.svg?style=for-the-badge" alt="Latest Version"/></a>
<a href="https://packagist.org/packages/telegram-bot-sdk/addon-manager"><img src="https://img.shields.io/packagist/dt/telegram-bot-sdk/addon-manager.svg?style=for-the-badge" alt="Total Downloads"/></a>
</p>

Addon Manager to add, remove, manage and load addons into [Telegram Bot SDK][link-sdk].

If you want to develop addons for [Telegram Bot SDK][link-sdk], please make sure to require this package in your composer file.

## Install

``` bash
$ composer require telegram-bot-sdk/addon-manager
```

## Usage

### Create An Addon

```php
<?php

namespace Acme\Addons;

use Telegram\Bot\Addon\Addon;
use Telegram\Bot\Events\UpdateEvent;

class AcmeAddon extends Addon
{
    public function register()
    {
        $this->bot->onUpdate(function (UpdateEvent $event) {
            $bot = $event->bot;
            $update = $event->update;

            // Do something with the inbound update received.
        });
    }
}
```

### Register Addon

#### Auto-Discovery

The Addon Manager supports auto-discovery which registers the addons automatically.
 
Simply create a `discovery.json` file in your project root.

```json
{
  "telegram/addon-config": [
    "config/acme.php"
  ],
  "telegram/addon": [
    "Acme\\Addons\\AcmeAddon"
  ]
}
```

#### Manually Register

```php
use Acme\Addons\AcmeAddon;
use Telegram\Bot\Addon\AddonManager;

// Make sure to register before initializing bot manager.
AddonManager::register(AcmeAddon::class);
```

### Remove Addon

```php
AddonManager::remove(AcmeAddon::class);
```

### Get Addons

```php
$addons = AddonManager::getAddons();
```

### Auto-Discover & Register Addons

```php
AddonManager::discover();
```

## Are You Using Telegram Bot SDK?

If you're using this SDK to build your Telegram Bots or have a project that's relevant to this SDK, We'd love to know and share it with the world.

Head over to [Awesome Telegram Bots][link-awesome-telegram-bots] to share, discover, and learn more.

## Contributing

Thank you for considering contributing to the project. Please read [the contributing guide][link-contributing] before creating an issue or sending in a pull request.

## Code of Conduct

Please read our [Code of Conduct][link-code-of-conduct] before contributing or engaging in discussions.

## Security

If you discover a security vulnerability within this project, please email Syed at `syed at lukonet.com`. All security vulnerabilities will be promptly addressed. You may view our full security policy [here][link-security-policy].

## Credits

- [Irfaq Syed][link-author]
- [All Contributors][link-contributors]

## License

This project is open-sourced software licensed under the [BSD 3-Clause][link-license] license.

[link-author]: https://github.com/irazasyed
[link-sdk]: https://github.com/telegram-bot-sdk/telegram-bot-sdk
[link-repo]: https://github.com/telegram-bot-sdk/addon-manager
[link-contributors]: https://github.com/telegram-bot-sdk/addon-manager/contributors
[link-license]: https://github.com/telegram-bot-sdk/addon-manager/blob/master/LICENSE.md
[link-contributing]: https://github.com/telegram-bot-sdk/addon-manager/blob/master/.github/CONTRIBUTING.md
[link-code-of-conduct]: https://github.com/telegram-bot-sdk/addon-manager/blob/master/.github/CODE_OF_CONDUCT.md
[link-security-policy]: https://github.com/telegram-bot-sdk/addon-manager/security/policy
[link-awesome-telegram-bots]: https://github.com/telegram-bot-sdk/awesome-telegram-bots
