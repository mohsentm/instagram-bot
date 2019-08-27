<?php

namespace App\Listeners\BotCoreListener\StoryFeedResponseListeners;

use App\Events\BotCoreEvents\StoryFeedResponseEvent;
use App\Exceptions\InstagramException\InvalidInstagramActionType;
use App\Services\BotCoreService\BotCoreService;

class SetSeeStoryAction
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
     * @param StoryFeedResponseEvent $storyFeedResponseEvent
     * @throws InvalidInstagramActionType
     */
    public function handle(StoryFeedResponseEvent $storyFeedResponseEvent): void
    {
        $this->botCoreService->setSeeStoryAction($storyFeedResponseEvent->instagramAccount, $storyFeedResponseEvent->feedResponse);
    }
}
