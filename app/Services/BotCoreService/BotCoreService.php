<?php

namespace App\Services\BotCoreService;

use App\Events\BotCoreEvents\BotWakeupEvent;
use App\Events\BotCoreEvents\TimelineFeedResponseEvent;
use App\Events\InstagramActionsEvents\LikeActionEvent;
use App\Models\InstagramAccount;
use App\Models\InstagramAction;
use App\Repositories\InstagramRepositories\InstagramActionRepository;
use App\Services\Instagram\ActionsService;
use Illuminate\Support\Facades\Log;
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
        Log::debug('Count of account '. count($accounts));

        foreach ($accounts as $account) {
            event(new BotWakeupEvent($account));
        }
    }

    /**
     * @param InstagramAccount $instagramAccount
     * @param InstagramAction $action
     * @throws \App\Exceptions\InstagramException\InstagramNullResponseException
     */
    public function timelineManage(InstagramAccount $instagramAccount, InstagramAction $action): void
    {
        $timelineFeedResponse = $this->actionsService->timeline->updateTimeLineAction($instagramAccount, $action);
        event(new TimelineFeedResponseEvent($instagramAccount, $timelineFeedResponse));
    }

    /**
     * @param InstagramAccount $instagramAccount
     * @param TimelineFeedResponse $feedItems
     * @throws \App\Exceptions\InstagramException\InvalidInstagramActionType
     */
    public function setLikeMediaAction(InstagramAccount $instagramAccount, TimelineFeedResponse $feedItems): void
    {
        Log::debug('load timeline: username:' . $instagramAccount->username);
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
        $this->actionsService->media->likeMedia($instagramAccount, $this->actionRepository->getLikeAction($instagramAccount));

        if ($this->actionRepository->likeActionExists($instagramAccount)) {
            event(new LikeActionEvent($instagramAccount));
        }
    }
}
