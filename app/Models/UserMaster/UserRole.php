<?php
namespace App\Models\UserMaster;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserMaster\Role;
class UserRole  extends Model
{
    protected $table = "user_role";
    protected $fillable = [
        'user_id','role_id',
    ];
	public function role()
    {
        return $this->hasMany(Role::class,'id','role_id');
    }
}
