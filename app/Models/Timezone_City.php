<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timezone_City extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','timezone'
    ];
    public function city_dropdown(){
        return $this->belongsTo(DropdownType::class);
    }
}
