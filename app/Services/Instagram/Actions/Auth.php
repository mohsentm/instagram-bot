<?php


namespace App\Services\Instagram\Actions;

use App\Services\Instagram\BaseApi;

class Auth extends BaseApi
{
    public function username(){
        return $this->api->username;
    }

    public function login(string $username, string $password){
       return $this->api->login($username, $password);
    }

}