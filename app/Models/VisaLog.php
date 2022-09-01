<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject', 'url', 'method', 'ip', 'agent', 'user_id', 'visa_id'
    ];
}
