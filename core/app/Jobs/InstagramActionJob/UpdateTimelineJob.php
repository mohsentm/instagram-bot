<?php

namespace App\Jobs\InstagramActionJob;

use App\Events\InstagramActionsEvents\TimeLineActionEvent;
use App\Services\BotCoreService\BotCoreService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateTimelineJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $actionEvent;

    /**
     * UpdateTimelineJob constructor.
     * @param TimeLineActionEvent $actionEvent
     */
    public function __construct(TimeLineActionEvent $actionEvent)
    {
        $this->actionEvent = $actionEvent;
    }

    /**
     * @param BotCoreService $botCoreService
     * @throws \App\Exceptions\InstagramException\InstagramNullResponseException
     */
    public function handle(BotCoreService $botCoreService): void
    {
        $botCoreService->timelineManage($this->actionEvent->instagramAccount, $this->actionEvent->action);
    }
}
