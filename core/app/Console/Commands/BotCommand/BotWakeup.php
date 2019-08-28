<?php

namespace App\Console\Commands\BotCommand;

use App\Services\BotCoreService\BotCoreService;
use Illuminate\Console\Command;

class BotWakeup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bot:wakeup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wakeup the bot';

    /** @var BotCoreService  */
    private $botCoreService;

    /**
     * BotWakeup constructor.
     * @param BotCoreService $botCoreService
     */
    public function __construct(BotCoreService $botCoreService)
    {
        parent::__construct();
        $this->botCoreService = $botCoreService;
    }

    /**
     * @throws \App\Exceptions\InstagramException\InvalidInstagramActionType
     */
    public function handle(): void
    {
        $this->comment('<fg=yellow>Bot service is wakeup</>');
        $this->botCoreService->wakeUp();
        $this->comment('<fg=green>Bot service process done</>');
    }
}
