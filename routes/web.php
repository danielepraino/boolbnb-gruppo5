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

Auth::routes();

Route::get('/', 'GeneralController@home');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search', 'SearchController@index')->name('search');
Route::get('/statistic', 'StatisticController@index')->name('statistic');

Route::get('/geolocation', function() {
  return view('/geolocation');
});

Route::resource('flats', 'FlatController');
