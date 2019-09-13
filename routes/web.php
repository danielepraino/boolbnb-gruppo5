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

Route::post('/search', 'SearchController@index')->name('search');
Route::get('/statistic', 'StatisticController@index')->name('statistic');

Route::get('/geolocation', function() {
  return view('/geolocation');
});

Route::resource('flats', 'FlatController');
Route::resource('messages', 'MessageController');
Route::resource('sponsorship', 'SponsorshipController');


Route::post('/sendmessage', 'MessageController@store');


//--------------------------------------------------------------

//Route::get('/sponsorship', 'SponsorshipController@index')->name('sponsorship');

Route::post('/checkout', 'CheckoutController@index')->name('checkout');
