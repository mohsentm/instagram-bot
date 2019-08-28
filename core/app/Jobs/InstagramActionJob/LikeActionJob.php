<?php

namespace App\Jobs\InstagramActionJob;

use App\Events\InstagramActionsEvents\LikeActionEvent;
use App\Services\BotCoreService\BotCoreService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class LikeActionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $actionEvent;

    /**
     * LikeActionJob constructor.
     * @param LikeActionEvent $actionEvent
     */
    public function __construct(LikeActionEvent $actionEvent)
    {
        $this->actionEvent = $actionEvent;
    }

    /**
     * @param BotCoreService $botCoreService
     * @throws \App\Exceptions\InstagramException\InstagramNullResponseException
     */
    public function handle(BotCoreService $botCoreService): void
    {
        $botCoreService->likeMediaAction($this->actionEvent->instagramAccount);
    }
}
