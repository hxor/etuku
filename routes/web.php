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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
   Route::resource('typecom', 'TypeComController');
   Route::resource('typeprice', 'TypePriceController');
   Route::resource('market', 'MarketController');
   Route::resource('unit', 'UnitController');
   Route::resource('comcat', 'ComcatController');
   Route::resource('commodity', 'CommodityController');
   Route::resource('comprice', 'CompriceController');
   Route::resource('com/{slug}/price', 'CompriceController');
});

Route::group(['prefix' => 'table', 'as' => 'table.'], function () {
    Route::get('market', 'MarketController@dataTable')->name('market');
    Route::get('typeprice', 'TypePriceController@dataTable')->name('typeprice');
    Route::get('typecom', 'TypeComController@dataTable')->name('typecom');
    Route::get('comcat', 'ComcatController@dataTable')->name('comcat');
    Route::get('commodity', 'CommodityController@dataTable')->name('commodity');
    Route::get('unit', 'UnitController@dataTable')->name('unit');
    Route::get('com/{slug}/price', 'CompriceController@dataTable')->name('com.price');
});
