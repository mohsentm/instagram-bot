<?php

namespace App\Services\Instagram\ServerAPI;

use App\Services\Instagram\Actions\Media;
use App\Services\Instagram\ServerAPI\Actions\Story;
use App\Services\Instagram\ServerAPI\Actions\Timeline;

/**
 * Class InstagramServerApi
 * @package App\Services\Instagram\ServerAPI
 * @property-read Timeline $timeline
 * @property-read Media $media
 * @property-read Story $story
 */
class InstagramServerApi
{
    /** @var Timeline */
    public $timeline;

    /** @var Media */
    public $media;

    /** @var Story */
    public $story;

    public function __construct(
        Timeline $timeline,
        Media $media,
        Story $story
    ) {
        $this->timeline = $timeline;
        $this->media = $media;
        $this->story = $story;
    }
}
