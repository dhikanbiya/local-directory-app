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

Route::get('home', 'HomeController@index',['middleware'=>['auth','active']])->name('home');

Route::group(['middleware'=>['auth','active']],function(){
	Route::resource('office','OfficeController');
	Route::resource('fuel','FuelController');
	Route::resource('site','SiteController');
	Route::resource('worship','WorshipController');
	Route::resource('restaurant','RestaurantController');	
	Route::resource('menu','MenuController',['except'=>
		'index'
		]);
	Route::get('manage/edit',array('as'=>'editpass','uses'=>'ManageController@edit'));
	Route::patch('manage/updatepass',array('as'=>'updatepass','uses'=>'ManageController@updatePass'));
});

Route::group(['middleware' => ['auth','admin','active']], function(){
	Route::resource('manage','ManageController',['except'=>['edit']]); 	
});

Route::get('menu/create/{id}',array('as'=>'createmenu','uses'=>'MenuController@create'),['middleware'=>['auth','active']]);


