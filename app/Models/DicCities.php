<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DicCities extends Model
{
    use HasFactory;

    public function region()
    {
        return $this->hasOne(DicRegions::class, 'id', 'region_id');
    }
}
