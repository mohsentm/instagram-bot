<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstagramAction extends Model
{
    protected $table = 'instagram_action';

    protected $fillable = [
        'account_id',
        'action_id',
        'action_type'
    ];
}
