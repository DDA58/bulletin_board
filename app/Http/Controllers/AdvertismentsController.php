<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adverts;

class AdvertismentsController extends Controller
{
    public function index() {
    	$cAvderts = Adverts::get();
		return view('advertisments.index', ['cAvderts' => $cAvderts]);
    }
}
