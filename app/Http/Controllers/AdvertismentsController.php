<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adverts;

class AdvertismentsController extends Controller
{
    public function index() {
		$cAvderts = Adverts::paginate(10);
		return view('advertisments.index', ['cAvderts' => $cAvderts]);
    }
}
