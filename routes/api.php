<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::group(['prefix' => 'market'], function () {
        Route::get('/', 'MarketController@index');
    });

    Route::group(['prefix' => 'commodity'], function () {
        Route::get('/{market}', 'CommodityController@getComByMarket');
    });

    Route::group(['prefix' => 'price'], function () {
        Route::get('market/{market}', 'CommodityController@getPriceByMarket');
    });
});
