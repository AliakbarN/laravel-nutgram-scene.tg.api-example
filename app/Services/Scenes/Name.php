<?php

namespace App\Services\Scenes;

use SceneApi\BaseScene;
use SergiX44\Nutgram\Nutgram;

class Name extends BaseScene
{
    public array $middlewares = [
        \App\Services\Middlewares\Name::class
    ];

    public string|null $enterCondition = 'command=start';

    public function onEnter(Nutgram $bot): void
    {
        $bot->sendMessage('Hi, send your name', $bot->chatId());
    }

    public function onQuery(Nutgram $bot): void
    {
        $userName = $bot->message()->text;
        $this->setData(['userName' => $userName], $bot->userId());

        $bot->sendMessage('Welcome ' . $userName, $bot->chatId());

        $this->next($bot, 'age');
    }
}
