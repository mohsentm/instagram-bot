<?php

namespace App\Jobs\InstagramActionJob\StoryJobs;

use App\Events\InstagramActionsEvents\StoryActionEvent;
use App\Exceptions\InstagramException\InstagramNullResponseException;
use App\Services\BotCoreService\BotCoreService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class StoryActionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $actionEvent;

    /**
     * StoryActionJob constructor.
     * @param StoryActionEvent $actionEvent
     */
    public function __construct(StoryActionEvent $actionEvent)
    {
        $this->actionEvent = $actionEvent;
    }

    /**
     * @param BotCoreService $botCoreService
     * @throws InstagramNullResponseException
     */
    public function handle(BotCoreService $botCoreService): void
    {
        $botCoreService->storyManage($this->actionEvent->instagramAccount, $this->actionEvent->action);
    }
}
