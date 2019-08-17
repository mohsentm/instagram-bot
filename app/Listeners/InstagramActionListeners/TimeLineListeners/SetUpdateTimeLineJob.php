<?php

namespace App\Listeners\InstagramActionListeners\TimeLineListeners;

use App\Events\InstagramActionsEvents\SetTimeLineActionEvent;
use App\Jobs\InstagramActionJob\UpdateTimeLineJob;
use Illuminate\Support\Facades\Log;

class SetUpdateTimeLineJob
{
    /**
     * Handle the event.
     *
     * @param  setTimeLineActionEvent  $actionEvent
     * @return void
     */
    public function handle(SetTimeLineActionEvent $actionEvent): void
    {
        UpdateTimeLineJob::dispatch($actionEvent);
        Log::debug('catch the event',(array)$actionEvent->instagramAccount);
    }
}
