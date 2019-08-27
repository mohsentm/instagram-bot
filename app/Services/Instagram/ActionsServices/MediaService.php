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
    public function isMedia(FeedItem $feedItem): bool
    {
        return !$feedItem->getMediaOrAd()->isAd();
    }

    public function isValidMedia(FeedItem $feedItem): bool
    {
        return $feedItem->getMediaOrAd()->getCode() !== null;
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
            if (
                $feedItem->getMediaOrAd() !== null &&
                $this->isMedia($feedItem) &&
                $this->isValidMedia($feedItem)
            ) {
                Log::debug('id: ' . $feedItem->getMediaOrAd()->getId());
                Log::debug('pk: ' . $feedItem->getMediaOrAd()->getPk());
                Log::debug('media code: ' . $feedItem->getMediaOrAd()->getCode());
                Log::debug('media url: ' . $feedItem->getMediaOrAd()->getItemUrl());
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
        )->like($action->action_id);

        Log::debug('Like media response status ' . $response->getStatus());
        return $response->getStatus();
    }
}
