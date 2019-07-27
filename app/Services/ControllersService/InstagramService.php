<?php


namespace App\Services\ControllersService;


use App\Repositories\InstagramRepositories\InstagramAccountRepository;
use App\Tools\AccountPassCrypt;

class InstagramService
{
    private $accountRepository;

    public function __construct(InstagramAccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function register($data){
        return $this->accountRepository->createAccount(
            $data['username'],
            $data['password'],
            $data['status'] ?? InstagramAccountRepository::DEFAULT_STATUS
        );
    }

}
