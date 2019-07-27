<?php


namespace App\Services\Instagram;

use InstagramAPI\Instagram as API;

abstract class BaseApi
{
    protected $api;

    public function __construct(API $api)
    {
        $this->api = $api;
    }

}