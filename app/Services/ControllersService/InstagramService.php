<?php


namespace App\Services\ControllersService;


use App\Repositories\InstagramAccountRepository;
use App\Tools\AccountPassCrypt;

class InstagramService
{
    private $accountRepository;

    public function __construct(InstagramAccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function register($username,$password){
        return $this->accountRepository->create([
            'username'=>$username,
            'password'=> AccountPassCrypt::encrypt($password,$username)
        ]);
    }

}