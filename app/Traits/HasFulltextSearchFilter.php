<?php
namespace App\Traits;

trait HasFulltextSearchFilter
{
//    public static function bootSearchable()
//    {
//        if (config('services.elasticsearch.enabled')) {
//            static::observe(ElasticsearchObserver::class);
//        }
//    }
    /**
     * Get es search index
     *
     * @return string
     */
    public function getSearchIndex() : string {
        return defined(self::class.'::ELASTICSEARCH_INDEX') ? self::ELASTICSEARCH_INDEX : $this->getTable();
    }

    /**
     * Get es search type
     *
     * @return string
     */
    public function getSearchType() : string {
        return defined(self::class.'::ELASTICSEARCH_TYPE') ? self::ELASTICSEARCH_TYPE : $this->getTable();
    }

    /**
     * Get es search fields with coefficients
     *
     * @return array
     */
    public function getSearchFields() : array {
        return defined(self::class.'::ELASTICSEARCH_FIELDS') ? self::ELASTICSEARCH_FIELDS : $this->toArray();
    }

    /**
     * Get es search fields without coefficients
     *
     * @return array
     */
    public function getSearchFieldsWithoutCoefficient() : array {
        $fields = $this->getSearchFields();
        return array_map(fn($field) => preg_replace('/\^[0-9]+$/', '', $field), $fields);
    }

    /**
     * Get data from model by search fields
     *
     * @return array
     */
    public function getDataBySearchFields() : array {
        $data = [];
        $fields = $this->getSearchFieldsWithoutCoefficient();

        foreach ($fields as $field) {
            $attributes = $this->toArray();
            if(array_key_exists($field, $attributes))
                $data[$field] = $attributes[$field];
        }
        return $data;
    }
}
