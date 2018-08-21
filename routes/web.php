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


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
   Route::resource('typecom', 'TypeComController');
   Route::resource('typeprice', 'TypePriceController');
   Route::resource('market', 'MarketController');
   Route::resource('unit', 'UnitController');
   Route::resource('comcat', 'ComcatController');
   Route::resource('commodity', 'CommodityController');
   Route::resource('comprice', 'CompriceController');
});
