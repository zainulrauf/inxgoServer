<?php
namespace App\Models\UserMaster;
use Illuminate\Database\Eloquent\Model;
class Permission extends Model 
{
    protected $table = "permisions";
    protected $fillable = [
        'name','display_name','module','status','module_id'
    ];
}
