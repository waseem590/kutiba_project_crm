<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'portal_name','portal_link','password','show_password','user_name'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
