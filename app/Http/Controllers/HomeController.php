<?php

namespace App\Http\Controllers;

use App\Models\Adverts;

class HomeController extends Controller
{
    /**
     * Get main app page with ads
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Adverts $adverts) {
        $cAvderts = $adverts->with('city')->with('region')->filter()->paginate(10);
        $cAvderts->withPath(app()->router->generateCurrentRouteWithFilters());

        return view('advertisments.index', ['cAvderts' => $cAvderts]);
    }
}
