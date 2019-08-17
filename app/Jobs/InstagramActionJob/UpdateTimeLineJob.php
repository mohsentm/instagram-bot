<?php

namespace App\Jobs\InstagramActionJob;

use App\Events\InstagramActionsEvents\SetTimeLineActionEvent;
use App\Services\Instagram\AccountManager;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class UpdateTimeLineJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $actionEvent;

    /**
     * UpdateTimeLineJob constructor.
     * @param SetTimeLineActionEvent $actionEvent
     */
    public function __construct(SetTimeLineActionEvent $actionEvent)
    {
        $this->actionEvent = $actionEvent;
    }

    /**
     * @param AccountManager $accountManager
     */
    public function handle(AccountManager $accountManager): void
    {
        Log::info('update time line: username: '.$this->actionEvent->instagramAccount->username
        .' action type: '.$this->actionEvent->action->action_type);
        $accountManager->updateTimeLineAction($this->actionEvent->instagramAccount, $this->actionEvent->action);
    }
}
