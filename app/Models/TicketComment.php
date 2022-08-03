<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tickets_id',
        'users_id',
        'comment',
    ];

    public function tickets(){
        return $this->belongsTo(Ticket::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}
