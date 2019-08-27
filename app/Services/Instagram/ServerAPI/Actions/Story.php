<?php

namespace App\Services\Instagram\ServerAPI\Actions;

use InstagramAPI\Response\MediaSeenResponse;
use InstagramAPI\Response\ReelsTrayFeedResponse;

/**
 * Class Timeline
 * @package App\Services\Instagram\ServerAPI\Actions
 */
class Story extends BaseApi
{
    /**
     * @return ReelsTrayFeedResponse
     */
    public function getReelsTrayFeed(): ReelsTrayFeedResponse
    {
        return $this->api->story->getReelsTrayFeed();
    }

    public function markMediaSeen(string ...$items): MediaSeenResponse
    {
        return $this->api->story->markMediaSeen($items);
    }
}
