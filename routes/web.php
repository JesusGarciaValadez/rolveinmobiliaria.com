<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Auth::routes();

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

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::prefix('/call_trackings')->middleware(['auth'])->group(function () {
  Route::get('/', 'CallController@index')
       ->name('call_trackings');

  Route::get('/new', 'CallController@create')
       ->name('create_call');

  Route::post('/store', 'CallController@store')
       ->name('store_call');

  Route::get('/show/{id}', 'CallController@show')
       ->name('show_call');

  Route::get('/edit/{id}', 'CallController@edit')
       ->name('edit_call');

  Route::put('/uptate/{id}', 'CallController@update')
       ->name('update_call');

  Route::delete('/destroy/{id}', 'CallController@destroy')
       ->name('destroy_call');

  Route::get('/search/{date?}', 'CallController@search')
       ->name('search_call');
});

Route::prefix('/for_sales')->middleware(['auth'])->group(function () {
  Route::get('/', 'SaleController@index')
       ->name('for_sales');

  Route::get('/new', 'SaleController@create')
       ->name('create_sale');

  Route::post('/store', 'SaleController@store')
       ->name('store_sale');

  Route::get('/show/{id}', 'SaleController@show')
       ->name('show_sale');

  Route::get('/edit/{id}', 'SaleController@edit')
       ->name('edit_sale');

  Route::put('/uptate/{id}', 'SaleController@update')
       ->name('update_sale');

  Route::delete('/destroy/{id}', 'SaleController@destroy')
       ->name('destroy_sale');

  Route::get('/search/{date?}', 'SaleController@search')
       ->name('search_sale');
});
