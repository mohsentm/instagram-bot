<?php

namespace App\Services\BotCoreService;

use App\Events\BotCoreEvents\BotWakeupEvent;
use App\Events\BotCoreEvents\StoryFeedResponseEvent;
use App\Events\BotCoreEvents\TimelineFeedResponseEvent;
use App\Events\InstagramActionsEvents\LikeActionEvent;
use App\Events\InstagramActionsEvents\SeeStoryActionEvent;
use App\Exceptions\InstagramException\InstagramNullResponseException;
use App\Exceptions\InstagramException\InvalidInstagramActionType;
use App\Models\InstagramAccount;
use App\Models\InstagramAction;
use App\Repositories\InstagramRepositories\InstagramActionRepository;
use App\Services\Instagram\ActionsService;
use Illuminate\Support\Facades\Log;
use InstagramAPI\Response\ReelsTrayFeedResponse;
use InstagramAPI\Response\TimelineFeedResponse;

class BotCoreService
{
    /** @var ActionsService */
    private $actionsService;
    /** @var InstagramActionRepository */
    private $actionRepository;

    /**
     * BotCoreService constructor.
     * @param ActionsService $actionsService
     * @param InstagramActionRepository $actionRepository
     */
    public function __construct(
        ActionsService $actionsService,
        InstagramActionRepository $actionRepository
    ) {
        $this->actionsService = $actionsService;
        $this->actionRepository = $actionRepository;
    }

    /**
     * Set wakeup event for all enable accounts
     */
    public function wakeUp(): void
    {
        Log::info('Bot service is wakeup');
        $accounts = $this->actionsService->account->getAccountWithoutAction();
        if ($accounts->isEmpty()) {
            Log::debug('There is not account');
            return;
        }
        Log::debug('Count of account ' . count($accounts));

        foreach ($accounts as $account) {
            event(new BotWakeupEvent($account));
        }
    }

    /**
     * @param InstagramAccount $instagramAccount
     * @param InstagramAction $action
     * @throws InstagramNullResponseException
     */
    public function timelineManage(InstagramAccount $instagramAccount, InstagramAction $action): void
    {
        $timelineFeedResponse = $this->actionsService->timeline->updateTimeLineAction($instagramAccount, $action);
        event(new TimelineFeedResponseEvent($instagramAccount, $timelineFeedResponse));
    }

    /**
     * @param InstagramAccount $instagramAccount
     * @param InstagramAction $action
     * @throws InstagramNullResponseException
     */
    public function storyManage(InstagramAccount $instagramAccount, InstagramAction $action): void
    {
        $storyFeedResponse = $this->actionsService->story->updateStoryAction($instagramAccount, $action);
        event(new StoryFeedResponseEvent($instagramAccount, $storyFeedResponse));
    }

    /**
     * @param InstagramAccount $instagramAccount
     * @param ReelsTrayFeedResponse $feedItems
     * @throws InvalidInstagramActionType
     */
    public function setSeeStoryAction(InstagramAccount $instagramAccount, ReelsTrayFeedResponse $feedItems): void
    {
        Log::debug('set see story action: username:' . $instagramAccount->username);
        $setEvent = $this->actionsService->story->setSeenAction($instagramAccount, $feedItems);
        if ($setEvent) {
            event(new SeeStoryActionEvent($instagramAccount));
        }
    }

    public function seeStoryAction(InstagramAccount $instagramAccount): void
    {
        if ($this->actionRepository->seeStoryActionDoesntExist($instagramAccount)) {
            return;
        }
        $this->actionsService->story->markMediaSeen(
            $instagramAccount,
            $this->actionRepository->getSeeStoryAction($instagramAccount)
        );

        if ($this->actionRepository->seeStoryActionExists($instagramAccount)) {
            event(new SeeStoryActionEvent($instagramAccount));
        }
    }

    /**
     * @param InstagramAccount $instagramAccount
     * @param TimelineFeedResponse $feedItems
     * @throws InvalidInstagramActionType
     */
    public function setLikeMediaAction(InstagramAccount $instagramAccount, TimelineFeedResponse $feedItems): void
    {
        Log::debug('set like media action: username:' . $instagramAccount->username);
        $setEvent = $this->actionsService->media->setLikeAction($instagramAccount, $feedItems);
        if ($setEvent) {
            event(new LikeActionEvent($instagramAccount));
        }
    }

    /**
     * @param InstagramAccount $instagramAccount
     */
    public function likeMediaAction(InstagramAccount $instagramAccount): void
    {
        if ($this->actionRepository->likeActionDoesntExist($instagramAccount)) {
            return;
        }

        $action = $this->actionRepository->getLikeAction($instagramAccount);
        $this->actionsService->media->likeMedia($instagramAccount, $action);
        $this->actionRepository->doneAction($action);

        if ($this->actionRepository->likeActionExists($instagramAccount)) {
            event(new LikeActionEvent($instagramAccount));
        }
    }
}
