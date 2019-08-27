<?php

namespace App\Listeners\InstagramActionListeners\StoryListeners;

use App\Events\InstagramActionsEvents\SeeStoryActionEvent;
use App\Jobs\InstagramActionJob\StoryJobs\SeenStoryActionJob;
use Illuminate\Support\Facades\Log;

class SetSeeStoryActionJob
{
    /**
     * @param SeeStoryActionEvent $actionEvent
     */
    public function handle(SeeStoryActionEvent $actionEvent): void
    {
        SeenStoryActionJob::dispatch($actionEvent)
            ->delay(now()->addMinutes());
        Log::debug('catch the see story event ');
    }
}
