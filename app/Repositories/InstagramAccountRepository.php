<?php


namespace App\Repositories;


use App\Models\InstagramAccount;

class InstagramAccountRepository extends BaseRepository
{

    function model()
    {
       return InstagramAccount::class;
    }

}