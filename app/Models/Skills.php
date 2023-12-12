<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Skills extends Model 
{
    protected $table = "Skill";
    public $timestamps = false;
    protected $fillable = [
        'Title','ServiceTypeId','PhotoPath','UpdatedDate','UpdatedBy','IsActive'
    ];
}
