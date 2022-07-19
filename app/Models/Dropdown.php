<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DropdownType;

class Dropdown extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function dropdownType(){
        return $this->hasMany(DropdownType::class, 'dropdowns_id');
    }
}
