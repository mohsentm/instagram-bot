<?php

namespace App\Listeners\InstagramActionListeners\StoryListeners;

use App\Events\InstagramActionsEvents\LikeActionEvent;
use App\Jobs\InstagramActionJob\StoryJobs\StoryActionJob;
use Illuminate\Support\Facades\Log;

class SetStoryActionJob
{
    /**
     * @param LikeActionEvent $actionEvent
     */
    public function handle(LikeActionEvent $actionEvent): void
    {
        StoryActionJob::dispatch($actionEvent);
        Log::debug('catch the story event ');
    }
}
