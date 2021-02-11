<?php


namespace App\Providers;


use App\Services\FulltextSearch\Elasticsearch;
use App\Services\FulltextSearch\IFulltextSearch;
use App\Services\FulltextSearch\SqlFulltextSearch;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class FulltextSearchProvider extends ServiceProvider
{
    public function register()
    {
        $this->bindSearchClient();

        $this->app->bind(IFulltextSearch::class, function ($app) {
            if (!config('services.elasticsearch.enabled'))
                return new SqlFulltextSearch();

            return $app->make(Elasticsearch::class);
        });
    }

    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.elasticsearch.hosts'))
                ->build();
        });
    }
}
