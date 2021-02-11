<?php


namespace App\Models\Filters;


use App\Models\AdCategories;
use Illuminate\Database\Eloquent\Builder;

class Category implements IFilter
{
    /**
     * Apply filter. Add condition to builder
     *
     * @param Builder $builder
     * @param mixed $filterValue
     * @return Builder
     */
    public static function apply(Builder $builder, $filterValue) : Builder{
        $categories = AdCategories::whereCode($filterValue)->with('childCategories')->get();
        if($categories->isNotEmpty())
            $categories = $categories->merge(AdCategories::treeToList($categories));
        $category_ids =  collect($categories)->pluck('id');
        $tableName = $builder->getModel()->getTable();

        return $category_ids->isNotEmpty() ? $builder->whereIn($tableName.'.category_id', $category_ids) : $builder;
    }
}
