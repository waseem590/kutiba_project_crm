<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;
    protected $fillable = [
            'en_title',
            'ar_title',
            'web_link',
            'uni_file',
            'doc_file',
            'ppt_file',
            'exl_file',
            'english_summernote',
            'arabic_summernote',
            'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}