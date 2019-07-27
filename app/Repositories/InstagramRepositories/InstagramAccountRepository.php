<?php

namespace App\Repositories\InstagramRepositories;

use App\Models\InstagramAccount;
use App\Repositories\BaseRepository;
use App\Tools\AccountPassCrypt;

/**
 * Class InstagramAccountRepository
 * @package App\Repositories\InstagramRepositories
 */
class InstagramAccountRepository extends BaseRepository
{
    /** @var string */
    public const STATUS_ENABLE = 'ENABLE';
    /** @var string */
    public const STATUS_DISABLE = 'DISABLE';
    /** @var array */
    public const STATUS_LIST = [self::STATUS_ENABLE, self::STATUS_DISABLE];
    /** @var string */
    public const DEFAULT_STATUS = self::STATUS_DISABLE;

    /**
     * @return mixed|string
     */
    public function model()
    {
        return InstagramAccount::class;
    }

    public function createAccount(string $username, string $password, string $status = self::DEFAULT_STATUS)
    {
        return $this->query->create([
            'username' => $username,
            'password' => AccountPassCrypt::encrypt($password, $username),
            'status' => $status
        ]);
    }

    public function getAccounts($withPassword = false)
    {
        $result = $this->query->where(['status' => 'ENABLE'])->get();
        if ($withPassword) {
            $result = $result->makeVisible(['password'])->map(static function ($item) {
                $item->password = AccountPassCrypt::decrypt($item->password, $item->username);
                return $item;
            });
        }
        return $result;
    }

    public function getAccountWithoutAction()
    {
        return $this->query->doesntHave('actions')
            ->where(['status' => 'ENABLE'])->get();
    }
}
