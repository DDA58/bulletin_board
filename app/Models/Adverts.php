<?php

namespace App\Models;

use App\Traits\HasFulltextSearchFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\FilterScope;
use Illuminate\Support\Carbon;

class Adverts extends Model
{
    use HasFactory, FilterScope, HasFulltextSearchFilter;

    const ELASTICSEARCH_FIELDS = ['title^2', 'description'];
    const ELASTICSEARCH_INDEX = 'board';
    const ELASTICSEARCH_TYPE = 'adverts';

    public function city() {
        return $this->hasOne(DicCities::class, 'id', 'city_id');
    }

    public function region() {
        return $this->hasOneThrough(DicRegions::class, DicCities::class, 'id', 'id', 'city_id', 'region_id');
    }

    /**
     * Get publish date
     *
     * @param  string  $value
     * @return string
     */
    public function getPublishDateAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y');
    }
}
