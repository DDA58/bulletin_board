<?php


namespace App\Models\Filters;


use Illuminate\Database\Eloquent\Builder;

class PriceMin implements IFilter
{

    /**
     * Apply filter. Add condition to builder
     *
     * @param Builder $builder
     * @param mixed $filterValue
     * @return Builder
     */
    public static function apply(Builder $builder, $filterValue) : Builder
    {
        return $filterValue && is_numeric($filterValue) ? $builder->where('cost', '>=', (int)$filterValue) : $builder;
    }
}
