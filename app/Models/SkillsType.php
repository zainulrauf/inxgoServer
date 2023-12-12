<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SkillsType extends Model 
{
    protected $table = "ServiceType";
    public $timestamps = false;
    protected $fillable = [
        'Title','PhotoPath','UpdatedDate','UpdatedBy','IsActive'
    ];
}
