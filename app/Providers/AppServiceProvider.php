<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('advertisments.sidebar', function ($view) {
            $cCategories = \App\Models\AdCategories::whereParentId(0)->with('childCategories')->get();
            $view->with('cCategories', $cCategories);
        });

        View::composer('advertisments.searchbar', function ($view) {                      
            $cRegions = \App\Models\DicRegions::get();
            $cCities =  \App\Models\DicCities::get();
            $view->with(['cRegions' => $cRegions,  'cCities' => $cCities]);
        });
    }
}
