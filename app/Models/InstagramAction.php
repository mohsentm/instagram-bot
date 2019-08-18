<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InstagramAction
 * @package App\Models
 * @property integer $id
 * @property integer $account_id
 * @property string $action_id
 * @property string $action_type
 * @property string $status
 * @property-read InstagramAccount $account
 */
class InstagramAction extends Model
{
    protected $table = 'instagram_action';

    protected $fillable = [
        'account_id',
        'action_id',
        'action_type'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(InstagramAccount::class);
    }
}
