<?php
namespace App\Models\UserMaster;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserMaster\Permission;
class RolePermission extends Model 
{
    protected $table = "role_permisions";
    protected $fillable = [
        'permision_id','role_id',
    ];
    public function permisions()
    {
        return $this->belongsTo(Permission::class,'permision_id','id');
    }
}
