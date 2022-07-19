<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AddStudent;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'add_student_id',
        'course_id',
        'task_id',
        'comment_text',
    ];
    public function student()
    {
        return $this->belongsTo(AddStudent::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
