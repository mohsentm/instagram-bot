<?php

namespace App\Services\Instagram\ActionsServices;

use App\Repositories\InstagramRepositories\InstagramAccountRepository;
use App\Repositories\InstagramRepositories\InstagramActionRepository;
use App\Services\Instagram\ServerAPI\InstagramServerApi;

abstract class BaseService
{
    protected $accountRepository;
    protected $actionRepository;
    protected $serverApi;

    public function __construct(
        InstagramAccountRepository $accountRepository,
        InstagramActionRepository $actionRepository,
        InstagramServerApi $serverApi
    ) {
        $this->accountRepository = $accountRepository;
        $this->actionRepository = $actionRepository;
        $this->serverApi = $serverApi;
    }
}
