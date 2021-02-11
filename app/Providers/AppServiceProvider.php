<?php

namespace App\Providers;

use App\Models\AdCategories;
use App\Models\DicCities;
use App\Models\DicRegions;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Http\Request;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        View::composer('advertisments.sidebar', function ($view) {
            $cCategories = AdCategories::whereParentId(0)->with('childCategories')->orderBy('title')->get();

            $openedCategories = [];
            if(request()->has('f_category')) {
                $list_categories = AdCategories::treeToList($cCategories);

                $oSelectedCategory = $list_categories->first(function($category) {
                    return $category->code === request()->f_category;
                });
                $openedCategories = [];
                if($oSelectedCategory)
                    $openedCategories[] = $oSelectedCategory->id;
                $openedCategories = array_merge($openedCategories, AdCategories::getAllParents($oSelectedCategory)->pluck('id')->toArray());
            }

            $view->with(['cCategories' => $cCategories, 'openedCategories' => $openedCategories]);
        });

        View::composer('advertisments.searchbar', function ($view) {
            $cRegions = DicRegions::orderBy('name')->get();
            $cCities = [];
            $sCheckedRegionName = 'Все регионы';
            $sCheckedCityName = 'Все города';
            if(request()->has('f_region')) {
                $oCheckedRegion = $cRegions->first(function($region) {
                    return $region->id == request()->f_region;
                });
                $sCheckedRegionName = $oCheckedRegion->name;

                $cCities = DicCities::whereRegionId(request()->f_region)->orderBy('name')->get();

                if(request()->has('f_city')) {
                    $oCheckedCity = $cCities->first(function($city) {
                        return $city->slug == request()->f_city;
                    });
                    if($oCheckedCity)
                        $sCheckedCityName = $oCheckedCity->name;
                }
            }

            $view->with(['cRegions' => $cRegions,  'cCities' => $cCities, 'sCheckedRegionName' => $sCheckedRegionName, 'sCheckedCityName' => $sCheckedCityName]);
        });
    }
}
