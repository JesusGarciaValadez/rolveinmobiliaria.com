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

// Route::prefix('seguimiento_de_llamadas')->group(function () {
  Route::get('/seguimiento_de_llamadas', 'CallController@index')
    ->name('call_trackings');
  Route::get('/seguimiento_de_llamadas/nueva', 'CallController@create')
    ->name('create_call');
  Route::post('/seguimiento_de_llamadas/{id}', 'CallController@store')
    ->name('store_call');
  Route::get('/seguimiento_de_llamadas/{id}', 'CallController@show')
    ->name('show_call');
  Route::put('/seguimiento_de_llamadas/{id}', 'CallController@edit')
    ->name('show_call');
  Route::patch('/seguimiento_de_llamadas/{id}', 'CallController@update')
    ->name('update_call');
  Route::delete('/seguimiento_de_llamadas/{id}', 'CallController@destroy')
    ->name('destroy_call');
// });
