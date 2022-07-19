<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dropdown;
use App\Models\AddStudent;

class DropdownType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','dropdowns_id'
    ];

    public function dropdown(){
        return $this->belongsTo(Dropdown::class);
    }

    public function visa(){
        return $this->hasMany(DropdownType::class);
    }

    public function students()
    {
        return $this->belongsToMany(AddStudent::class)->withPivot(['id','course_complete','course_accepted']);
    }
    public function timezone(){
        return $this->hasOne(Timezone_City::class,'dropdown_types_id');
    }
    public function clock_user(){
        return $this->belongsToMany(User::class, 'users_cities','dropdown_type_id','user_id');
    }
}
