<?php


namespace App\Models\Filters;


use Illuminate\Database\Eloquent\Builder;

class Region implements IFilter
{
    /**
     * Apply filter. Add condition to builder
     *
     * @param Builder $builder
     * @param mixed $filterValue
     * @return Builder
     */
    public static function apply(Builder $builder, $filterValue) : Builder {
        $tableName = $builder->getModel()->getTable();

        return $builder
            ->leftJoin('dic_cities AS city_region', 'city_region.id', '=', $tableName.'.city_id')
            ->leftJoin('dic_regions', 'dic_regions.id', '=', 'city_region.region_id')
            ->where('dic_regions.id', $filterValue);
    }
}
