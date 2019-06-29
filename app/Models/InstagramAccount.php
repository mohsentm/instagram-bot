<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

}
