<?php

namespace Telegram\Bot\Addon;

use Telegram\Bot\Addon\Contracts\AddonContract;
use Telegram\Bot\Bot;

abstract class Addon implements AddonContract
{
    protected Bot $bot;

    public function bot(): Bot
    {
        return $this->bot;
    }

    public function setBot(Bot $bot): self
    {
        $this->bot = $bot;

        return $this;
    }
}
