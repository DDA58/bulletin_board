<?php


namespace App\Services\Filters;


use Illuminate\Database\Eloquent\Builder;

interface IFilterCreator
{
    const REG_EXP_IDENTIFY_PATTERN = '/^f_.*/';
    const REG_EXP_REPLACE_PATTERN = '/^f_/';
    const FILTERS_MODELS_PATH = 'App\Models\Filters\\';

    /**
     * Apply creator to builder
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder) : Builder;
}
