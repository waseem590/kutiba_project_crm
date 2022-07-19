<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visa_Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'visa_id',
        'comment_text'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function visa_comment(){
        return $this->belongsTo(Visa::class);
    }
}
