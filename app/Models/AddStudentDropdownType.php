<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AddStudent;

class AddStudentDropdownType extends Model
{
    use HasFactory;
    protected $table = 'add_student_dropdown_type';
    protected $fillable = [
        'dropdown_type_id',
        'course_accepted',
        'course_complete',
        'course_complete_date',
        'course_start_date'
    ];

}
