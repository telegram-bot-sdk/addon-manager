<?php

namespace Telegram\Bot\Addon;

use Telegram\Bot\Bot;
use Telegram\Bot\Exceptions\TelegramSDKException;
use TheCodingMachine\Discovery\Discovery;

class AddonManager
{
    /** @var array Addons List */
    protected static array $addons = [];

    /**
     * Get Addons List.
     *
     * @return array
     */
    public static function getAddons(): array
    {
        return self::$addons;
    }

    /**
     * Auto-discover and register.
     *
     * @throws TelegramSDKException
     */
    public static function discover(): void
    {
        $addons = Discovery::getInstance()->get('telegram/addon');

        foreach ($addons as $addon) {
            self::register($addon);
        }
    }

    /**
     * Add an addon to the list.
     *
     * @param string $addon Addon class name
     *
     * @throws TelegramSDKException
     */
    public static function register(string $addon): void
    {
        if (! class_exists($addon) && ! is_subclass_of($addon, Addon::class)) {
            throw new TelegramSDKException(
                'Failed to register [' . $addon . '] addon. It does not exists or not a valid class.'
            );
        }

        array_unshift(self::$addons, $addon);

        self::$addons = array_values(array_unique(self::$addons));
    }

    /**
     * Remove an addon from the list.
     *
     * @param string $addon Addon class name
     */
    public static function remove(string $addon): void
    {
        foreach (array_keys(self::$addons, $addon) as $key) {
            unset(self::$addons[$key]);
        }
    }

    /**
     * Load registered addons.
     *
     * @param Bot $bot
     */
    public static function loadAddons(Bot $bot): void
    {
        collect(self::$addons)->each(
            fn ($addon) => $bot->getContainer()->make($addon)->setBot($bot)->register()
        );
    }
}
