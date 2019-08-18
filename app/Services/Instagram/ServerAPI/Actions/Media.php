<?php

namespace App\Services\Instagram\Actions;

use App\Services\Instagram\ServerAPI\Actions\BaseApi;
use InstagramAPI\Response\GenericResponse;

/**
 * Class Media
 * @package App\Services\Instagram\Actions
 */
class Media extends BaseApi
{
    public function like(string $mediaId): GenericResponse
    {
        return $this->api->media->like($mediaId);
    }
}
