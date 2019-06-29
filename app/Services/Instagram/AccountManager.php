<?php


namespace App\Services\Instagram;

use App\Repositories\InstagramAccountRepository;
use App\Tools\AccountPassCrypt;

class AccountManager
{

    private $accountRepository;

    public function __construct(InstagramAccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }


    public function run()
    {
        $account = $this->getAccounts();

        return $account;
    }


    private function getAccounts() {
        $account = $this->accountRepository->makeModel()->select('username',
            'password')->where(['status' => 'ENABLE'])->get()->makeVisible(['password']);

        $account = $account->map(static function($item) {
            $item->password = AccountPassCrypt::decrypt($item->password, $item->username);
            return $item;
        });
        return $account;
    }
}