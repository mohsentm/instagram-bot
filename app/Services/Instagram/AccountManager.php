<?php

namespace App\Services\Instagram;

use App\Models\InstagramAccount;
use App\Repositories\InstagramRepositories\InstagramAccountRepository;
use App\Repositories\InstagramRepositories\InstagramActionRepository;
use Illuminate\Support\Facades\Log;

class AccountManager
{
    private $accountRepository;
    private $actionRepository;

    public function __construct(
        InstagramAccountRepository $accountRepository,
    InstagramActionRepository $actionRepository
    )
    {
        $this->accountRepository = $accountRepository;
        $this->actionRepository = $actionRepository;
    }

    public function getAccountWithoutAction()
    {
        return $this->accountRepository->getAccountWithoutAction();
    }

    /**
     * @param InstagramAccount $instagramAccount
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @throws \App\Exceptions\InstagramException\InvalidInstagramActionType
     */
    public function setTimelineAction(InstagramAccount $instagramAccount)
    {
        $result = $this->actionRepository->setAction(
            $instagramAccount,
            InstagramActionRepository::ACTION_TIMELINE
        );

        Log::info('Set the '.InstagramActionRepository::ACTION_TIMELINE.' action for '.$instagramAccount->username);

        return $result;
    }
}
