<?php

namespace App\Models\UserMaster;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserMaster\RolePermission;
class Role extends Model
{
    protected $table = "roles";
    protected $fillable = [
        'name','status',
    ];
    public function permission()
    {
        return $this->hasMany(RolePermission::class,'role_id','id');
    }
}
