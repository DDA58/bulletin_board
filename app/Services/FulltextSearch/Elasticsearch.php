<?php


namespace App\Services\FulltextSearch;

use App\Services\Filters\IFilterCreator;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;


class Elasticsearch implements IFulltextSearch
{
    protected Client $elasticsearch;
    protected Model $model;
    protected Request $request;
    private string $query = '';

    /**
     *
     * @param  Client $elasticsearch
     * @param  Request $request
     * @return void
     */
    public function __construct(Client $elasticsearch, Request $request)
    {
        $this->elasticsearch = $elasticsearch;
        $this->request = $request;
        $this->query = $this->getQueryFromRequest();
    }

    /**
     * Search and find at SQL DB
     *
     * @return Collection
     */
    public function search() : Collection
    {
        $items = $this->searchOnElasticsearch();
        return $this->buildCollection($items);
    }

    /**
     * Search at ES
     *
     * @return array
     */
    private function searchOnElasticsearch(): array
    {
        $items = $this->elasticsearch->search([
            'index' => $this->model->getSearchIndex(),
            'type' => $this->model->getSearchType(),
            'size' => 100,
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fuzziness' => 'AUTO',
                        'fields' => $this->model->getSearchFields(),
                        'query' => $this->query,
                    ],
                ],
            ],
        ]);

        return $items;
    }

    /**
     * Find at SQL DB
     *
     * @param array $items
     * @return Collection
     */
    private function buildCollection(array $items): Collection
    {
        $ids = $this->pluckIds($items);
        return $this->model::findMany($ids)
            ->sortBy(function ($model) use ($ids) {
                return array_search($model->getKey(), $ids);
            });
    }

    /**
     * Search at ES and build query condition
     *
     * @param Builder $builder
     * @return Builder
     */
    public function getBuilderWithCondition(Builder $builder) : Builder {
        $items = $this->searchOnElasticsearch();
        $ids = $this->pluckIds($items);
        if(empty($ids))
           return $builder->whereRaw('false');

        $condition = '';
        $fullColumnName = $this->model->getTable().'.'.$this->model->getKeyName();
        foreach ($ids as $key => $id)
            $condition .= ($fullColumnName.'= ?'.(array_key_exists($key + 1, $ids) ? ' DESC ,' : ' DESC'));

        return $builder->whereIn($fullColumnName, $ids)
            ->orderByRaw($condition, $ids);
    }

    /**
     * Pluck ids from ES result
     *
     * @param array $ids
     * @return array
     */
    private function pluckIds(array $ids = []) : array {
        return Arr::pluck($ids['hits']['hits'], '_id');
    }

    /**
     * Check when model need fulltext search by trait existing and request param
     *
     * @return bool
     */
    public function needFullSearch() : bool {
        $reflection = new \ReflectionClass($this->model);
        $traits = $reflection->getTraits();
        $hasTrait  = (bool)count(preg_grep (self::REG_EXP_MODEL_HAS_FULLTEXT_SEARCH_PATTERN, array_keys($traits)));

        return $hasTrait&&(bool)$this->query;
    }

    /**
     * Get needle query param from request
     *
     * @return string
     */
    protected function getQueryFromRequest() : string {
        $params = preg_grep (self::REG_EXP_IDENTIFY_FULLTEXT_SEARCH_PATTERN, array_keys($this->request->all()));
        $query = count($params) ? $this->request->{array_shift($params)} : '';

        return $query;
    }

    /**
     * Set model
     *
     * @param Model $model
     * @return IFulltextSearch
     */
    public function setModel(Model $model) : IFulltextSearch {
        $this->model = $model;
        return $this;
    }
}
