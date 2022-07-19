<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentContactDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'add_students_id',
        'email',
        'secondary_email',
        'contact_number',
        'secondary_contact_number',
        'address_details',
        'street_address',
        'suburb',
        'state',
        'country',
        'post_code',
    ];
}
