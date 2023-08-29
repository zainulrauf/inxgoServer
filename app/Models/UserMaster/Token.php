<?php

namespace App\Models\UserMaster;
use Illuminate\Database\Eloquent\Model;
class Token extends Model
{
    protected $table = "token";
    protected $fillable = [
        'custom','laravel','user_id','status',
    ];
}
