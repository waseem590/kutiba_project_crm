<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class birthday extends Model
{
    use HasFactory;
    protected $fillable = [
        'birthday_title',
        'quotation',
        'watermark',
        'footer_note'
    ];
}
