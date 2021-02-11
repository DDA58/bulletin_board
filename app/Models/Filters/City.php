<?php


namespace App\Models\Filters;


use Illuminate\Database\Eloquent\Builder;

class City implements IFilter
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
            ->leftJoin('dic_cities', 'dic_cities.id', '=', $tableName.'.city_id')
            ->where('dic_cities.slug', $filterValue);
    }
}
