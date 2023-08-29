<?php
namespace App\Models\UserMaster;
use Illuminate\Database\Eloquent\Model;
class UserAddress extends Model 
{
    protected $table = "user_address";
    protected $fillable = [
        'user_id','street','apartment','floor'
    ];
}
