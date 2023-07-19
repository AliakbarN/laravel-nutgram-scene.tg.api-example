<?php

namespace App\Services\Middlewares;

use SceneApi\Services\BaseMiddleware;
use SergiX44\Nutgram\Nutgram;

class Phone extends BaseMiddleware
{
    public function handle(Nutgram $bot, callable $next): void
    {
        $userMobilePhone = $bot->message()->text;
        if (preg_match("/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/", $userMobilePhone)) {
            $next();
        } else {
            $bot->sendMessage('Your number is incorrect');
        }
    }
}
