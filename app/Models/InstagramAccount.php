<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstagramAccount extends Model
{
    use SoftDeletes;

    protected $table = 'instagram_account';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
