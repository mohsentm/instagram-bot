<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InstagramAccount
 * @package App\Models
 * @property BigInteger $id
 * @property string $username
 * @property string $password
 * @property string $status
 * @property-read Collection|InstagramAction[] $actions
 */
class InstagramAccount extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'username',
        'password',
        'status'
    ];

    protected $hidden = [
        'password'
    ];

    protected $table = 'instagram_accounts';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actions()
    {
        return $this->hasMany(InstagramAction::class, 'account_id');
    }

}
