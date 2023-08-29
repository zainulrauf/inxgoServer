<?php
namespace App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
class Type extends Model 
{
    protected $table = "ticket_type";
    protected $fillable = [
        'name','status'
    ];
}
