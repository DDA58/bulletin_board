<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DicRegions extends Model
{
    use HasFactory;

    public function cities()
    {
        return $this->hasMany(DicCities::class, 'region_id', 'id');
    }
}
