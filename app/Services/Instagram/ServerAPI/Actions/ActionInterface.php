<?php

namespace App\Services\Instagram\ServerAPI\Actions;

use App\Services\Instagram\ServerAPI\InstagramServerApi;

interface ActionInterface
{
    public function __construct(InstagramServerApi $instagramServerApi);
}
