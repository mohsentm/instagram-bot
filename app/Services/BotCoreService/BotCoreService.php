<?php

namespace App\Services\BotCoreService;

use App\Services\Instagram\AccountManager;
use Illuminate\Support\Facades\Log;

class BotCoreService
{
    /** @var AccountManager  */
    private $accountManager;

    /**
     * BotCoreService constructor.
     * @param AccountManager $accountManager
     */
    public function __construct(AccountManager $accountManager)
    {
        $this->accountManager = $accountManager;
    }

    /**
     * @throws \App\Exceptions\InstagramException\InvalidInstagramActionType
     */
    public function wakeUp(): void
    {
        Log::info('Bot service is wakeup');
        $accounts = $this->accountManager->getAccountWithoutAction();
        if ($accounts->isEmpty()) {
            return;
        }

        foreach ($accounts as $account) {
            $this->accountManager->setTimelineAction($account);
        }
    }
}
