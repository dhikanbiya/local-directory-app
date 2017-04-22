<?php

namespace App\Http\Controllers;

use App\Manage;
use App\Office;
use App\Restaurant;
use App\Worship;
use App\Fuel;
use App\Site;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $office = Office::all()->count();
	$user = Manage::all()->count();
	$restaurant = Restaurant::all()->count();
	$worship = Worship::all()->count();
	$fuel = Fuel::all()->count();
	$site = Site::all()->count();
	return view('home',compact(['user','worship','office','site','fuel','restaurant']));
    }
}
