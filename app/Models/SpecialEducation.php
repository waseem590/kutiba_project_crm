<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialEducation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'applications_id',
        'certificate_1',
        'certificate_2',
        'certificate_3',
        'certificate_4',
        'foundation',
        'associate_degree'
    ];

    protected $dates = ['deleted_at'];

    public function se_application(){
        return $this->belongsTo(Application::class);
    }
}
