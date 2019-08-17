<?php


namespace App\Services\Instagram\Actions;

use App\Services\Instagram\BaseApi;

class LikeAction extends BaseApi
{
    public function like(int $mediaId){
        return $this->api->media->like($mediaId);
    }
}
