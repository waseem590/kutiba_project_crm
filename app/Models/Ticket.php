<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'ticket_no',
        'title',
        'periority',
        'message',
        'status',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeTicketRelations(){
        return $this->with('comments')->with('users');
    }
}
