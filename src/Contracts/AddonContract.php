<?php

namespace Telegram\Bot\Addon\Contracts;

interface AddonContract
{
    /**
     * Register Addon.
     *
     * @return mixed
     */
    public function register();
}
