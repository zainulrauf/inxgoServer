<?php
namespace App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
class Status extends Model 
{
    protected $table = "ticket_status";
    protected $fillable = [
        'name','status'
    ];
}
