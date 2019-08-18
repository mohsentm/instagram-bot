<?php

namespace App\Repositories\InstagramRepositories;

use App\Models\InstagramAccount;
use App\Repositories\BaseRepository;
use App\Tools\AccountPassCrypt;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class InstagramAccountRepository
 * @package App\Repositories\InstagramRepositories
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $status
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

    public function getUserPassword(InstagramAccount $instagramAccount): string
    {
        return AccountPassCrypt::decrypt((string)$instagramAccount->password, (string)$instagramAccount->username);
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
        $result = $this->query->where(['status' => self::STATUS_ENABLE])->get();
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
        return $this->query->whereDoesntHave('actions', static function (Builder $query) {
            $query->where(['status' => InstagramActionRepository::STATUS_PENDING]);
        })->where(['status' => self::STATUS_ENABLE])->get();
    }
}
