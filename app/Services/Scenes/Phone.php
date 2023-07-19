<?php

namespace App\Services\Scenes;

use SceneApi\BaseScene;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;

class Phone extends BaseScene
{
    public array $middlewares = [
        \App\Services\Middlewares\Phone::class
    ];

    public function onEnter(Nutgram $bot): void
    {
        $bot->sendMessage("It's almost all, now, send your mobile phone", $bot->chatId());
    }

    public function onQuery(Nutgram $bot): void
    {
        $this->setData(['userPhone' => $bot->message()->text], $bot->userId());
        $bot->sendMessage('Thanks for information', $bot->chatId());
        $this->endPoint($bot);
    }

    protected function endPoint(Nutgram $bot) :void
    {
        $userId = $bot->userId();
        $bot->sendMessage(
            'Here they are all,
            Your profile
            <b>Name</b>: ' . $this->getData('userName', $userId) . '
            <b>Age</b>: ' . $this->getData('userAge', $userId) . '
            <b>Phone</b>: ' . $this->getData('userPhone', $userId)
            , $bot->chatId(), parse_mode: ParseMode::HTML);

        $this->break($userId);
    }
}
