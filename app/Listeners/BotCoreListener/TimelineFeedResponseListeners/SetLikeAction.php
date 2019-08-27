<?php

namespace App\Listeners\BotCoreListener\TimelineFeedResponseListeners;

use App\Events\BotCoreEvents\TimelineFeedResponseEvent;
use App\Services\BotCoreService\BotCoreService;

class SetLikeAction
{
    private $botCoreService;

    /**
     * SetLikeAction constructor.
     * @param BotCoreService $botCoreService
     */
    public function __construct(BotCoreService $botCoreService)
    {
        $this->botCoreService = $botCoreService;
    }

    /**
     * @param TimelineFeedResponseEvent $timelineFeed
     * @throws \App\Exceptions\InstagramException\InvalidInstagramActionType
     */
    public function handle(TimelineFeedResponseEvent $timelineFeed): void
    {
        $this->botCoreService->setLikeMediaAction($timelineFeed->instagramAccount, $timelineFeed->timelineFeedResponse);
    }
}
