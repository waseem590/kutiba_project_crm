<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AddStudent;

class StudentInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'add_students_id',
        'surname',
        'name',
        'dob',
        'gender',
        'nationality',
        'visa',
        'note',
    ];
    public function addStudent()
    {
        return $this->belongsTo(AddStudent::class);
    }
}
