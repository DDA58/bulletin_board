<?php


namespace App\Providers;


use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class FilterServiceProvider  extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Router::macro('generateCurrentRouteWithFilters', function (array $addParams = [], array $delParams = []) {
            try {
                $currentRouteName = $this->currentRouteName();
                $currentParams = $this->getCurrentRequest()->query();
                $modifiedParams = array_merge($currentParams, $addParams);
                foreach ($delParams as $param)
                    unset($modifiedParams[$param]);
                unset($modifiedParams['page']);
            } catch (\Exception $e) {
                return $this->container->url->route($currentRouteName, $currentParams);
            }
            return $this->container->url->route($currentRouteName, $modifiedParams);
        });
    }
}

