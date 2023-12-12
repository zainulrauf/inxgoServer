<?php
namespace App\Models\UserMaster;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\UserMaster\UserRole;
 
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = "User";
    // public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Rating',
        'Name',
        'UserId',
        'IsPhNoVerified',
        'Password',
        'PhNo',
        'IsAdmin',
        'IsActive',
        'CreatedDate',
        'UpdatedDate',
        'CreatedBy',
    ];
    //protected $hidden = [
    //'Location',
    //];
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
    public function role()
    {
        return $this->hasMany(UserRole::class);
    }
}
