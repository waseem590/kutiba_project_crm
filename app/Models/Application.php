<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'study_dest',
        'inst_name',
        'app_type',
        'duration',
        'start_date',
        'add_students_id',
        'status'
    ];

    protected $dates = ['deletes_at'];

    public function special_education()
    {
        return $this->hasOne(SpecialEducation::class, 'applications_id');
    }
    public function education()
    {
        return $this->hasOne(Education::class, 'applications_id');
    }
    public function scopeapplicationRelations()
    {
        return $this->with('special_education')->with('education');
    }
    public function user_applications()
    {
        return $this->belongsTo(User::class);
    }
    public function application_student()
    {
        return $this->belongsTo(AddStudent::class);
    }

}
