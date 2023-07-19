<?php

namespace App\Services\Scenes;

use SceneApi\BaseScene;
use SergiX44\Nutgram\Nutgram;

class Age extends BaseScene
{
    public array $middlewares = [
        \App\Services\Middlewares\Age::class
    ];

    public function onEnter(Nutgram $bot): void
    {
        $bot->sendMessage($this->getData('userName', $bot->userId()) . ', now, send your age', $bot->chatId());
    }

    public function onQuery(Nutgram $bot): void
    {
        $this->setData(['userAge' => $bot->message()->text], $bot->userId());
        $bot->sendMessage('I got it', $bot->chatId());

        $this->next($bot, 'phone');
    }
}
