<?php

namespace App\Listeners\InstagramActionListeners;

use App\Events\InstagramActionsEvents\TimeLineActionEvent;
use App\Jobs\InstagramActionJob\UpdateTimelineJob;
use Illuminate\Support\Facades\Log;

class SetUpdateTimeLineJob
{
    /**
     * Handle the event.
     *
     * @param  TimeLineActionEvent  $actionEvent
     * @return void
     */
    public function handle(TimeLineActionEvent $actionEvent): void
    {
        UpdateTimelineJob::dispatch($actionEvent);
        Log::debug('catch the event',(array)$actionEvent->instagramAccount);
    }
}
