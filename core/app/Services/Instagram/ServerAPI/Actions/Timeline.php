<?php

namespace App\Services\Instagram\ServerAPI\Actions;

use InstagramAPI\Response\TimelineFeedResponse;

/**
 * Class Timeline
 * @package App\Services\Instagram\ServerAPI\Actions
 */
class Timeline extends BaseApi
{
    /**
     * @return TimelineFeedResponse
     */
    public function getTimelineFeed(): TimelineFeedResponse
    {
        return $this->api->timeline->getTimelineFeed();
    }
}
