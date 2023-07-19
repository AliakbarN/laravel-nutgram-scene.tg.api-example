<?php

namespace App\Services\Middlewares;

use SceneApi\Services\BaseMiddleware;
use SergiX44\Nutgram\Nutgram;

class Name extends BaseMiddleware
{
    public function handle(Nutgram $bot, callable $next): void
    {
        $userName = $bot->message()->text;
        if (preg_match('/^[a-zA-Z]+$/', $userName)) {
            dump('next');
            $next();
        } else {
            $bot->sendMessage('Your name is incorrect, try again', $bot->chatId());
        }
    }
}
