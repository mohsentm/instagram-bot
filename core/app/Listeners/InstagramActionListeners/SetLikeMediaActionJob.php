<?php

namespace App\Listeners\InstagramActionListeners;

use App\Events\InstagramActionsEvents\LikeActionEvent;
use App\Jobs\InstagramActionJob\LikeActionJob;
use Illuminate\Support\Facades\Log;

class SetLikeMediaActionJob
{
    /**
     * @param LikeActionEvent $actionEvent
     */
    public function handle(LikeActionEvent $actionEvent): void
    {
        LikeActionJob::dispatch($actionEvent)
            ->delay(now()->addMinutes());
        Log::debug('catch the like event ');
    }
}
