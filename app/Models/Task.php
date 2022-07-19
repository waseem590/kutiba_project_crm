<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'add_students_id',
        'created_users_id',
        'task_name',
        'date',
        'status',
    ];
    public function task_user(){
        return $this->belongsTo(User::class);
    }
}
