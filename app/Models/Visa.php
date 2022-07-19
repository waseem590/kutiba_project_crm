<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
    ];
    public function student(){
        return $this->belongsTo(AddStudent::class);
    }

    public function dropdown(){
        return $this->belongsTo(Visa::class);
    }
    public function comment_visa(){
        return $this->hasMany(Visa_Comment::class,'visa_id');
    }
}
