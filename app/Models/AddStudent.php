<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentInformation;
use App\Models\StudentContactDetail;
use App\Models\StudentOtherInformation;
use App\Models\DropdownType;
use App\Models\Comment;

class AddStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'office',
        'users_id',
        'counsellor',
        'admission_officer',
        'visa_stu',
        'notification_status',
    ];

    /**
     * Get the user that owns the AddStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function info()
    {
        return $this->hasOne(StudentInformation::class, 'add_students_id');
    }

    /**
     * Get the user that owns the AddStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact()
    {
        return $this->hasOne(StudentContactDetail::class, 'add_students_id');
    }

    /**
     * Get the user that owns the AddStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function otherInfo()
    {
        return $this->hasOne(StudentOtherInformation::class, 'add_students_id');
    }
    public function scopestudentRelations()
    {
        return $this->with('info')->with('contact')->with('otherInfo');
    }
    public function scopestudentTwoRelation()
    {
        return $this->with('info')->with('contact');
    }
    public function student_applications()
    {
        return $this->hasMany(Application::class,'add_students_id',);
    }
    public function visa(){
        return $this->hasMany(Visa::class,'student_id');
    }
    public function role_counsellor(){
        return $this->belongsTo(User::class,'counsellor');
    }
    public function role_admission(){
        return $this->belongsTo(User::class,'admission_officer');
    }

    public function dropdowntypess()
    {
        return $this->belongsToMany(DropdownType::class)->withPivot(['id','course_complete','course_accepted']);
    }
    public function comments()
    {
    	return $this->hasMany(Comment::class);
    }
}
