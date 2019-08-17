<?php

namespace App\Services\Instagram;

use App\Events\InstagramActionsEvents\SetTimeLineActionEvent;
use App\Models\InstagramAccount;
use App\Models\InstagramAction;
use App\Repositories\InstagramRepositories\InstagramAccountRepository;
use App\Repositories\InstagramRepositories\InstagramActionRepository;
use App\Services\Instagram\ServerAPI\InstagramServerApi;
use Illuminate\Support\Facades\Log;

class AccountManager
{
    private $accountRepository;
    private $actionRepository;
    private $serverApi;

    public function __construct(
        InstagramAccountRepository $accountRepository,
        InstagramActionRepository $actionRepository,
        InstagramServerApi $serverApi
    ) {
        $this->accountRepository = $accountRepository;
        $this->actionRepository = $actionRepository;
        $this->serverApi = $serverApi;
    }

    public function getAccountWithoutAction()
    {
        return $this->accountRepository->getAccountWithoutAction();
    }

    /**
     * @param InstagramAccount $instagramAccount
     * @throws \App\Exceptions\InstagramException\InvalidInstagramActionType
     */
    public function setTimelineAction(InstagramAccount $instagramAccount): void
    {
        $action = $this->actionRepository->setAction(
            $instagramAccount,
            InstagramActionRepository::ACTION_TIMELINE
        );
        event(new SetTimeLineActionEvent($instagramAccount, $action));

        Log::info('Set the ' . InstagramActionRepository::ACTION_TIMELINE . ' action for ' . $instagramAccount->username);
    }

    /**
     * @param InstagramAccount $instagramAccount
     * @param InstagramAction $action
     */
    public function updateTimeLineAction(InstagramAccount $instagramAccount, InstagramAction $action): void
    {
        $this->actionRepository->doneAction($action);
        Log::info('time line updated username: '. $instagramAccount->username);
    }
}
