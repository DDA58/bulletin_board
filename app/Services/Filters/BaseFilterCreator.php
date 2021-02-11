<?php


namespace App\Services\Filters;

use App\Services\FulltextSearch\IFulltextSearch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BaseFilterCreator implements IFilterCreator
{
    protected Request $request;
    protected IFulltextSearch $fulltextSearch;

    public function __construct(Request $request, IFulltextSearch $fulltextSearch)
    {
        $this->request = $request;
        $this->fulltextSearch = $fulltextSearch;
    }

    /**
     * Apply creator to builder
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder) : Builder {
        $filters = $this->identifyFiltersInQuery();
        foreach ($filters as $filter => $value) {
            $filterName = $this->getObjectName($filter);
            $filterNameWithNamespace = $this->getNamespace().$filterName;
            if(!$this->isValidClass($filterNameWithNamespace))
                continue;
            $builder = $filterNameWithNamespace::apply($builder, $value);
        }

        try{
            if($this->fulltextSearch->needFullSearch())
                $builder = $this->fulltextSearch->getBuilderWithCondition($builder);
        }catch (\Exception $e) {}

        return $builder;
    }

    /**
     * Get all filter params from query
     *
     * @return array
     */
    protected function identifyFiltersInQuery() : array {
        return array_filter($this->request->query(), function($paramName) {
            return preg_match(self::REG_EXP_IDENTIFY_PATTERN, $paramName);
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Generate object name from query param name
     *
     * @param string $paramName
     * @return string
     */
    protected function getObjectName(string $paramName) : string {
        return ucfirst(Str::of(preg_replace(self::REG_EXP_REPLACE_PATTERN, '', $paramName))->camel());
    }

    /**
     * Check filter class existing
     *
     * @param string $objectName
     * @return bool
     */
    protected function isValidClass(string $objectName) : bool {
        return class_exists($objectName);
    }

    /**
     * Get filters namespace
     *
     * @return bool
     */
    protected function getNamespace() : string {
        return self::FILTERS_MODELS_PATH;
    }

    /**
     * Get fulltext search object
     *
     * @return IFulltextSearch
     */
    public function getFulltextSearch() : IFulltextSearch {
        return $this->fulltextSearch;
    }
}
