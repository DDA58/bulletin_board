<?php


namespace App\Services\FulltextSearch;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class SqlFulltextSearch implements IFulltextSearch
{
    /**
     * Base search
     *
     * @return Collection
     */
    public function search(): Collection
    {
        return collect([]);
    }

    /**
     * Check when model need fulltext search by trait existing and request param
     *
     * @return bool
     */
    public function needFullSearch(): bool
    {
        return false;
    }

    /**
     * Get query builder with generated condition
     *
     * @param Builder $builder
     * @return Builder
     */
    public function getBuilderWithCondition(Builder $builder): Builder
    {
        return $builder;
    }
}
