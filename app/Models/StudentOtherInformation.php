<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentOtherInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'add_students_id',
        'funding_type',
        'sponsor_name',
        'student_source',
        'cohort_name',
        'partner',
    ];
}
