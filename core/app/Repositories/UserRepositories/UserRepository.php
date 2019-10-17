<?php

namespace App\Repositories\UserRepositories;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return mixed|string
     */
    public function model()
    {
        return User::class;
    }


}
