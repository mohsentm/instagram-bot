<?php

namespace App\Services\Instagram\ActionsServices;

class AccountService extends BaseService
{
    public function getAccountWithoutAction()
    {
        return $this->accountRepository->getAccountWithoutAction();
    }
}
