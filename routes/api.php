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

//Route::get('/searched_flats', 'Api\ResearchFlatController@index');
Route::post('/filtered_flats', 'Api\ResearchFlatController@index')->name('filters');

// Route::get('/wifi_service', 'Api\ResearchFlatController@wifi_service');
//
// Route::get('/parking_service', 'Api\ResearchFlatController@parking_service');
//
// Route::get('/pool_service', 'Api\ResearchFlatController@pool_service');
//
// Route::get('/concierge_service', 'Api\ResearchFlatController@concierge_service');
//
// Route::get('/sauna_service', 'Api\ResearchFlatController@sauna_service');
//
// Route::get('/sea_view_service', 'Api\ResearchFlatController@sea_view_service');
