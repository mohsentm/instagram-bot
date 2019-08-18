<?php

namespace App\Services\Instagram\ServerAPI;

use App\Services\Instagram\Actions\Media;
use App\Services\Instagram\ServerAPI\Actions\Timeline;

/**
 * Class InstagramServerApi
 * @package App\Services\Instagram\ServerAPI
 * @property-read Timeline $timeline
 * @property-read Media $media
 */
class InstagramServerApi
{
    /** @var Timeline  */
    public $timeline;

    /** @var Media  */
    public $media;

    public function __construct(
        Timeline $timeline,
        Media $media
    )
    {
        $this->timeline = $timeline;
        $this->media = $media;
    }
}
