<?php

namespace Telegram\Bot\Addon\Laravel;

use Illuminate\Support\ServiceProvider;
use Telegram\Bot\Addon\AddonManager;

/**
 * Class AddonServiceProvider.
 */
class AddonServiceProvider extends ServiceProvider
{
    /**
     * @return mixed|void
     */
    public function boot()
    {
    }

    public function register(): void
    {
        AddonManager::discover();
    }
}
