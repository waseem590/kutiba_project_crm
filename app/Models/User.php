<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'dob',
        'password',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function application()
    {
        return $this->hasMany(Application::class);
    }
    public function universities()
    {
        return $this->hasMany(University::class, 'user_id');
    }
    public function visa(){

    }
    public function counsellor(){
        return $this->hasMany(AddStudent::class,'counsellor');
    }
    public function admission(){
        return $this->hasMany(AddStudent::class,'admission_officer');
    }
    public function add_many_user(){
        return $this->hasMany(LoginDetail::class,'admission_officer');
    }
    public function user_comment(){
        return $this->hasMany(Visa_Comment::class,'user_id');
    }
    public function user_clock(){
        return $this->belongsToMany(DropdownType::class, 'users_cities','user_id','dropdown_type_id');
    }
    public function user_task(){
        return $this->hasMany(Task::class,'created_users_id');
    }
    public function tickets(){
        return $this->hasMany(Ticket::class, 'users_id');
    }
    public function ticket_comments(){
        return $this->hasMany(TicketComment::class, 'users_id');
    }
}
