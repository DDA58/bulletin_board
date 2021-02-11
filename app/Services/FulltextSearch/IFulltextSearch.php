<?php


namespace App\Services\FulltextSearch;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface IFulltextSearch
{
	const REG_EXP_MODEL_HAS_FULLTEXT_SEARCH_PATTERN = '/\\HasFulltextSearchFilter/';
    const REG_EXP_IDENTIFY_FULLTEXT_SEARCH_PATTERN = '/^fts$/';

    /**
     * Base search
     *
     * @return Collection
     */
    public function search() : Collection;

    /**
     * Check when model need fulltext search by trait existing and request param
     *
     * @return bool
     */
	public function needFullSearch() : bool;

    /**
     * Get query builder with generated condition
     *
     * @param Builder $builder
     * @return Builder
     */
    public function getBuilderWithCondition(Builder $builder) : Builder;
}
