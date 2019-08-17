<?php

namespace App\Services\Instagram\ServerAPI;

use App\Services\Instagram\ServerAPI\Actions\Timeline;
use InstagramAPI\Instagram as API;

/**
 * Class InstagramServerApi
 * @package App\Services\Instagram\ServerAPI
 * @property-read $timeline
 */
class InstagramServerApi
{
    public $api;

    public $timeline;

    public function __construct(API $api)
    {
        $this->api = $api;

        $this->timeline = new Timeline($this);
    }

    public function getUsername()
    {
        return $this->api->username;
    }

    /**
     * @param string $username
     * @param string $password
     * @return $this
     */
    public function login(string $username, string $password)
    {
        return $this->api->login($username, $password);
    }

    public function getFeed()
    {
        return $this->api->timeline->getTimelineFeed()->getFeedItems();
    }
}
