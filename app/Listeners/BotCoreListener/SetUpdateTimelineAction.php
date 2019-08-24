<?php

namespace App\Listeners\BotCoreListener;

use App\Events\BotCoreEvents\BotWakeupEvent;
use App\Services\Instagram\ActionsService;

class SetUpdateTimelineAction
{
    private $accountService;

    /**
     * SetUpdateTimelineAction constructor.
     * @param ActionsService $accountService
     */
    public function __construct(ActionsService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * @param BotWakeupEvent $botWakeupEvent
     * @throws \App\Exceptions\InstagramException\InvalidInstagramActionType
     */
    public function handle(BotWakeupEvent $botWakeupEvent): void
    {
        $this->accountService->timeline->setTimelineAction($botWakeupEvent->instagramAccount);
    }
}
