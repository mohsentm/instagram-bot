<?php

namespace App\Services\Instagram\ServerAPI\Actions;

use App\Services\Instagram\ServerAPI\InstagramServerApi;

class Timeline implements ActionInterface
{
    private $parent;

    public function __construct(InstagramServerApi $parent)
    {
        $this->parent = $parent;
    }

    public function getFeed()
    {
        return $this->parent->api->getTimelineFeed()->getFeedItems();
    }
}
