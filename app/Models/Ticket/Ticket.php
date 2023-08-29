<?php
namespace App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
class Ticket extends Model 
{
    protected $table = "tickets";
    protected $fillable = [
        'name',
		'email',
		'title',
		'description',
		'ticket_type_id',
		'ticket_status_id',
		'user_id',
		'image',
    ];
}
