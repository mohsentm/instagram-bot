<?php

namespace App\Console\Commands\BotCommand;

use App\Repositories\InstagramRepositories\InstagramActionRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ActionFlush extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bot:flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = ' Flush all of the actions';

    /** @var InstagramActionRepository  */
    private $actionRepository;

    /**
     * ActionFlush constructor.
     * @param InstagramActionRepository $actionRepository
     */
    public function __construct(InstagramActionRepository $actionRepository)
    {
        parent::__construct();
        $this->actionRepository = $actionRepository;
    }

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $this->actionRepository->flushActions();
        $this->comment('<fg=green>Flushed the all actions</>');
        Log::info('Flushed the all actions by command');
    }
}
