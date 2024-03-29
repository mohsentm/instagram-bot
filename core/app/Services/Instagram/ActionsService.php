<?php

namespace App\Services\Instagram;

use App\Services\Instagram\ActionsServices\AccountService;
use App\Services\Instagram\ActionsServices\MediaService;
use App\Services\Instagram\ActionsServices\TimelineService;

/**
 * Class ActionsService
 * @package App\Services\Instagram
 * @property-read AccountService $account
 * @property-read TimelineService $timeline
 * @property-read MediaService $media
 */
class ActionsService
{
    public $account;
    public $timeline;
    public $media;

    public function __construct(
        AccountService $account,
        TimelineService $timeline,
        MediaService $media
    ) {
        $this->account = $account;
        $this->timeline = $timeline;
        $this->media = $media;
    }
}
