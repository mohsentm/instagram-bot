<?php

namespace App\Services\Instagram\ActionsServices;

use App\Events\InstagramActionsEvents\TimeLineActionEvent;
use App\Exceptions\InstagramException\InstagramNullResponseException;
use App\Models\InstagramAccount;
use App\Models\InstagramAction;
use App\Repositories\InstagramRepositories\InstagramActionRepository;
use Illuminate\Support\Facades\Log;
use InstagramAPI\Response\TimelineFeedResponse;

class TimelineService extends BaseService
{
    /**
     * @param InstagramAccount $instagramAccount
     * @throws \App\Exceptions\InstagramException\InvalidInstagramActionType
     */
    public function setTimelineAction(InstagramAccount $instagramAccount): void
    {
        $action = $this->actionRepository->setAction(
            $instagramAccount,
            InstagramActionRepository::ACTION_TIMELINE
        );

        event(new TimeLineActionEvent($instagramAccount, $action));

        Log::debug('Set the ' . InstagramActionRepository::ACTION_TIMELINE . ' action for ' . $instagramAccount->username);
    }

    /**
     * @param InstagramAccount $instagramAccount
     * @param InstagramAction $action
     * @return TimelineFeedResponse
     * @throws InstagramNullResponseException
     */
    public function updateTimeLineAction(InstagramAccount $instagramAccount, InstagramAction $action): TimelineFeedResponse
    {
        Log::debug('load timeline: username:'. $instagramAccount->username);
        $feeds = $this->serverApi->timeline->login(
                $instagramAccount->username,
                $this->accountRepository->getUserPassword($instagramAccount)
            )->getTimelineFeed();

        if($feeds === null) {
            throw new InstagramNullResponseException();
        }

        $this->actionRepository->doneAction($action);
        Log::debug('time line updated username: '. $instagramAccount->username);

        return $feeds;
    }
}
