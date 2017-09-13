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

Route::prefix('/seguimiento_de_llamadas')->middleware('auth')->group(function () {
  Route::get('/', 'CallController@index')
       ->name('call_trackings');
  Route::get('/nueva', 'CallController@create')
       ->name('create_call');
  Route::post('/{id}', 'CallController@store')
       ->name('store_call');
  Route::get('/{id}', 'CallController@show')
       ->name('show_call');
  Route::get('/{id}', 'CallController@edit')
       ->name('show_call');
  Route::patch('/{id}', 'CallController@update')
       ->name('update_call');
  Route::delete('/{id}', 'CallController@destroy')
       ->name('destroy_call');
});
