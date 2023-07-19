<?php

namespace App\Console\Commands;

use App\Services\Scenes\Age;
use App\Services\Scenes\Name;
use App\Services\Scenes\Phone;
use Illuminate\Console\Command;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SceneApi\SceneManager;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\RunningMode\Polling;

class RunTelegramBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:telegram-bot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     */
    public function handle() :void
    {
        try {
            $bot = new Nutgram($_ENV['TELEGRAM_API_TOKEN']);
            $bot->setRunningMode(Polling::class);
            $sceneManager = new SceneManager($bot, [Name::class, Age::class, Phone::class]);
            $sceneManager->process();
            $bot->run();
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface|\Exception $e) {
            dd($e->getMessage() . '   ' . $e->getFile() . ' ' . $e->getLine());
        }
    }
}
