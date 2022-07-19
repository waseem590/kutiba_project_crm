<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'accommodation_type',
        'placement_fee',
        'accommodation_fee',
        'arrival_date',
        'airport_pickup',
        'airport_pickup_fee',
        'status',
        'add_students_id',
    ];
}
