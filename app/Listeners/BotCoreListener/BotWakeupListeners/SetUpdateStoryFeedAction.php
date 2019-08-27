<?php

namespace App\Listeners\BotCoreListener\BotWakeupListeners;

use App\Events\BotCoreEvents\BotWakeupEvent;
use App\Exceptions\InstagramException\InvalidInstagramActionType;
use App\Services\Instagram\ActionsService;

class SetUpdateStoryFeedAction
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
     * @throws InvalidInstagramActionType
     */
    public function handle(BotWakeupEvent $botWakeupEvent): void
    {
        $this->accountService->story->setStoryAction($botWakeupEvent->instagramAccount);
    }
}
