<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InstagramAccount
 * @package App\Models
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $status
 * @property-read InstagramAction[] $actions
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
    public function actions(): HasMany
    {
        return $this->hasMany(InstagramAction::class, 'account_id');
    }
}
