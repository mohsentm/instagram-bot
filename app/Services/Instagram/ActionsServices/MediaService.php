<?php

namespace App\Services\Instagram\ActionsServices;

use App\Models\InstagramAccount;
use App\Models\InstagramAction;
use App\Repositories\InstagramRepositories\InstagramActionRepository;
use Illuminate\Support\Facades\Log;
use InstagramAPI\Response\Model\FeedItem;
use InstagramAPI\Response\TimelineFeedResponse;

class MediaService extends BaseService
{
    public function isMediaOrAd(FeedItem $feedItem): bool
    {
        return $feedItem->isMediaOrAd();
    }

    /**
     * @param InstagramAccount $instagramAccount
     * @param TimelineFeedResponse $feedItems
     * @return bool
     * @throws \App\Exceptions\InstagramException\InvalidInstagramActionType]
     */
    public function setLikeAction(InstagramAccount $instagramAccount, TimelineFeedResponse $feedItems): bool
    {
        $setEvent = false;
        foreach ($feedItems->getFeedItems() as $feedItem) {
            if ($feedItem->getMediaOrAd() !== null && $this->isMediaOrAd($feedItem)) {
                $this->actionRepository->setAction(
                    $instagramAccount,
                    InstagramActionRepository::ACTION_LIKE,
                    $feedItem->getMediaOrAd()->getId()
                );
                $setEvent = true;
            }
        }

       return $setEvent;
    }

    public function likeMedia(InstagramAccount $instagramAccount, InstagramAction $action): string
    {
        $response = $this->serverApi->media->login(
            $instagramAccount->username,
            $this->accountRepository->getUserPassword($instagramAccount)
        )->like($action->account_id);

        $this->actionRepository->doneAction($action);

        Log::debug('Like media response status '. $response->getStatus());
        return $response->getStatus();
    }
}
