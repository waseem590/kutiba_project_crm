<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_name',
        'job_title',
        'email',
        'contact_no',
        'contact_no2',
        'notes',
        'dob',
    ];
}
