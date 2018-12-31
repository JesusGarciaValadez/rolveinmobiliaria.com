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


Route::prefix('/v1')->name('v1.')->middleware('auth:api')->group(function ()
{
  Route::get('/client/show/{client}', 'Api\V1\ClientController@show');

  Route::get('/internal_expedient/show/{internal_expedient}', 'Api\V1\InternalExpedientController@show');
});
