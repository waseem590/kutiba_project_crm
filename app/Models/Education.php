<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'applications_id',
        'diploma',
        'd_start_date',
        'advance_diploma',
        'ad_start_date',
        'bachelor',
        'b_start_date',
        'bachelor_hons',
        'bh_start_date',
        'graduate_diploma',
        'gd_start_date',
        'masters_degree',
        'md_start_date',
        'doctoral_degree',
        'dd_start_date',
        'primary_school',
        'high_school'
    ];

    protected $dates = ['deleted_at'];

    public function e_application(){
        return $this->belongsTo(Application::class);
    }
}
