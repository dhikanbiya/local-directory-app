<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'],function(){
	Route::resource('office','OfficeController');
	Route::resource('fuel','FuelController');
	Route::resource('site','SiteController');
	Route::resource('worship','WorshipController');
	Route::resource('restaurant','RestaurantController');	
	Route::resource('menu','MenuController',['except'=>
		'index'
		]);
});

Route::group(['middleware' => 'admin'], function(){
	Route::resource('manage','ManageController'); 	
});


