<?php

namespace App\Services\Instagram;

use App\Services\Instagram\ActionsServices\AccountService;
use App\Services\Instagram\ActionsServices\MediaService;
use App\Services\Instagram\ActionsServices\StoryService;
use App\Services\Instagram\ActionsServices\TimelineService;

/**
 * Class ActionsService
 * @package App\Services\Instagram
 * @property-read AccountService $account
 * @property-read TimelineService $timeline
 * @property-read MediaService $media
 * @property-read StoryService $story
 */
class ActionsService
{
    /** @var AccountService */
    public $account;

    /** @var TimelineService */
    public $timeline;

    /** @var MediaService */
    public $media;

    /** @var StoryService */
    public $story;

    public function __construct(
        AccountService $account,
        TimelineService $timeline,
        MediaService $media,
        StoryService $story
    ) {
        $this->account = $account;
        $this->timeline = $timeline;
        $this->media = $media;
        $this->story = $story;
    }
}
