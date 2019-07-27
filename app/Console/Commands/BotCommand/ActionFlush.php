<?php

namespace App\Console\Commands\BotCommand;

use App\Exceptions\InstagramException\InvalidInstagramActionType;
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
    protected $signature = 'bot:flush {--id=} {--action=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /** @var InstagramActionRepository  */
    private $actionRepository;

    /**
     * ActionFlush constructor.
     * @param InstagramActionRepository $actionRepository
     */
    public function __construct(InstagramActionRepository $actionRepository)
    {
        $this->actionRepository = $actionRepository;
        $this->description = 'Flush all of the actions| filters: --id = Instagram account Id, --action = ['.
            implode(', ', InstagramActionRepository::ACTION_LIST).']';

        parent::__construct();
    }

    /**
     * @throws InvalidInstagramActionType
     */
    public function handle(): void
    {
        $filter = [];

        if($this->option('id')) {
            $filter['account_id'] = $this->option('id');
        }

        if ($this->option('action')) {
            if (!in_array(strtoupper($this->option('action')), InstagramActionRepository::ACTION_LIST, true)) {
             throw new InvalidInstagramActionType();
            }
                $filter['action_type'] = strtoupper($this->option('action'));
        }
        $this->actionRepository->flushActions($filter);
        $this->comment('<fg=green>Flushed the all actions</>');
        Log::info('Flushed the all actions by command');
    }
}
