<?php
namespace App\Models\UserMaster;
use Illuminate\Database\Eloquent\Model;
class Module extends Model 
{
    protected $table = "module";
    protected $fillable = [
        'name','status'
    ];
}
