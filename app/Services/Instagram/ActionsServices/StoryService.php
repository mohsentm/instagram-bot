<?php

namespace App\Services\Instagram\ActionsServices;

use App\Events\InstagramActionsEvents\StoryActionEvent;
use App\Exceptions\InstagramException\InstagramNullResponseException;
use App\Exceptions\InstagramException\InvalidInstagramActionType;
use App\Models\InstagramAccount;
use App\Models\InstagramAction;
use App\Repositories\InstagramRepositories\InstagramActionRepository;
use Illuminate\Support\Facades\Log;
use InstagramAPI\Response\ReelsTrayFeedResponse;

class StoryService extends BaseService
{
    /**
     * @param InstagramAccount $instagramAccount
     * @throws InvalidInstagramActionType
     */
    public function setStoryAction(InstagramAccount $instagramAccount): void
    {
        $action = $this->actionRepository->setAction(
            $instagramAccount,
            InstagramActionRepository::ACTION_STORY
        );

        event(new StoryActionEvent($instagramAccount, $action));

        Log::debug('Set the ' . InstagramActionRepository::ACTION_STORY . ' action for ' . $instagramAccount->username);
    }

    /**
     * @param InstagramAccount $instagramAccount
     * @param InstagramAction $action
     * @return ReelsTrayFeedResponse
     * @throws InstagramNullResponseException
     */
    public function updateStoryAction(InstagramAccount $instagramAccount, InstagramAction $action): ReelsTrayFeedResponse
    {
        Log::debug('load story: username:'. $instagramAccount->username);
        $feeds = $this->serverApi->story->login(
                $instagramAccount->username,
                $this->accountRepository->getUserPassword($instagramAccount)
            )->getReelsTrayFeed();

        if($feeds === null) {
            throw new InstagramNullResponseException();
        }

        $this->actionRepository->doneAction($action);
        Log::debug('time line updated username: '. $instagramAccount->username);

        return $feeds;
    }

    /**
     * @param InstagramAccount $instagramAccount
     * @param ReelsTrayFeedResponse $feedItems
     * @return bool
     * @throws InvalidInstagramActionType
     */
    public function setSeenAction(InstagramAccount $instagramAccount, ReelsTrayFeedResponse $feedItems): bool
    {
        foreach ($feedItems->getTray() as $feedItem) {
                Log::debug('is : ' . $feedItem->getId());
                Log::debug('is item: ' . $feedItem->isItems());
                Log::debug('is seen: ' . $feedItem->isSeen());
                Log::debug('is user: ' . $feedItem->isUser());
                $this->actionRepository->setAction(
                    $instagramAccount,
                    InstagramActionRepository::ACTION_SEE_STORY,
                    $feedItem->getId()
                );
        }

        return true;
    }

    public function markMediaSeen(InstagramAccount $instagramAccount,  array $actionIds): string
    {

        $response = $this->serverApi->story->login(
            $instagramAccount->username,
            $this->accountRepository->getUserPassword($instagramAccount)
        )->markMediaSeen($action->action_id);

        $this->actionRepository->doneAction($action);

        Log::debug('Like media response status ' . $response->getStatus());
        return $response->getStatus();
    }
}
