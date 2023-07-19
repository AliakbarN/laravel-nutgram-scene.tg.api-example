<?php

namespace App\Services\Middlewares;

use SceneApi\Services\BaseMiddleware;
use SergiX44\Nutgram\Nutgram;

class Age extends BaseMiddleware
{
    public function handle(Nutgram $bot, callable $next): void
    {
        $userAge = $bot->message()->text;

        if (is_numeric($userAge)) {
            $userAge = intval($userAge);
            if ($userAge >= 18) {
                $next();
            } else {
                $bot->sendMessage('You are too young', $bot->chatId());
            }
        } else {
            $bot->sendMessage('Your message is inappropriate', $bot->chatId());
        }
    }
}
