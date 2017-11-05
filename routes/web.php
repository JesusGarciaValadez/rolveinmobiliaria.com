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

Route::prefix('/clients')->group(function () {
  Route::get('/', 'ClientController@index')
       ->name('clients');

  Route::get('/new', 'ClientController@create')
       ->name('create_client');

  Route::post('/store', 'ClientController@store')
       ->name('store_client');

  Route::get('/show/{id}', 'ClientController@show')
       ->name('show_client');

  Route::get('/edit/{id}', 'ClientController@edit')
       ->name('edit_client');

  Route::put('/uptate/{id}', 'ClientController@update')
       ->name('update_client');

  Route::delete('/destroy/{id}', 'ClientController@destroy')
       ->name('destroy_client');

  Route::get('/search/{date?}', 'ClientController@search')
       ->name('search_client');
});

Route::prefix('/call_trackings')->middleware('auth')->group(function () {
  Route::get('/', 'CallController@index')
       ->name('call_trackings')
       ->middleware('can:calls.view, App\Sale');

  Route::get('/new', 'CallController@create')
       ->name('create_call')
       ->middleware('can:calls.create, App\Call');

  Route::post('/store', 'CallController@store')
       ->name('store_call')
       ->middleware('can:calls.create, call');

  Route::get('/show/{id}', 'CallController@show')
       ->name('show_call')
       ->middleware('can:calls.view, call');

  Route::get('/edit/{id}', 'CallController@edit')
       ->name('edit_call')
       ->middleware('can:calls.update, call');

  Route::put('/uptate/{id}', 'CallController@update')
       ->name('update_call')
       ->middleware('can:calls.update, call');

  Route::delete('/destroy/{id}', 'CallController@destroy')
       ->name('destroy_call')
       ->middleware('can:calls.delete, call');

  Route::get('/search/{date?}', 'CallController@search')
       ->name('search_call')
       ->middleware('can:calls.view, call');
});

Route::prefix('/for_sales')->middleware('auth')->group(function () {
  Route::get('/', 'SaleController@index')
       ->name('for_sales')
       ->middleware('can:sales.view, App\Sale');

  Route::get('/new', 'SaleController@create')
       ->name('create_sale')
       ->middleware('can:sales.create, App\Sale');

  Route::post('/store', 'SaleController@store')
       ->name('store_sale')
       ->middleware('can:sales.create, sale');

  Route::get('/show/{id}', 'SaleController@show')
       ->name('show_sale')
       ->middleware('can:sales.view, sale');

  Route::get('/edit/{id}', 'SaleController@edit')
       ->name('edit_sale')
       ->middleware('can:sales.update, update');

  Route::put('/uptate/{id}', 'SaleController@update')
       ->name('update_sale')
       ->middleware('can:sales.update, sale');

  Route::delete('/destroy/{id}', 'SaleController@destroy')
       ->name('destroy_sale')
       ->middleware('can:sales.delete, sale');

  Route::get('/search/{date?}', 'SaleController@search')
       ->name('search_sale');
});
