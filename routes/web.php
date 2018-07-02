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

Route::get('/', function ()
{
  return view('welcome');
});

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::prefix('/clients')->middleware('auth')->group(function ()
{
  Route::get('/', 'ClientController@index')
       ->name('clients')
       ->middleware('can:clients.view, App\Client');

  Route::get('/new', 'ClientController@create')
       ->name('create_client')
       ->middleware('can:clients.create, App\Client');

  Route::post('/store', 'ClientController@store')
       ->name('store_client')
       ->middleware('can:clients.create, client');

  Route::get('/show/{id}', 'ClientController@show')
       ->name('show_client')
       ->middleware('can:clients.view, client');

  Route::get('/edit/{id}', 'ClientController@edit')
       ->name('edit_client')
       ->middleware('can:clients.update, client');

  Route::put('/update/{id}', 'ClientController@update')
       ->name('update_client')
       ->middleware('can:clients.update, client');

  Route::delete('/destroy/{id}', 'ClientController@destroy')
       ->name('destroy_client')
       ->middleware('can:clients.delete, client');

  Route::get('/filter/{parameter?}', 'ClientController@filter')
        ->name('filter_client')
        ->middleware('can:clients.view, client');
});

Route::prefix('/messages')->middleware('auth')->group(function ()
{
  Route::get('/', 'MessageController@index')
       ->name('messages')
       ->middleware('can:messages.view, App\Messages');

  Route::get('/new', 'MessageController@create')
       ->name('create_message')
       ->middleware('can:messages.create, App\Message');

  Route::post('/store', 'MessageController@store')
       ->name('store_message')
       ->middleware('can:messages.create, message');

  Route::get('/show/{id}', 'MessageController@show')
       ->name('show_message')
       ->middleware('can:messages.view, message');

  Route::get('/edit/{id}', 'MessageController@edit')
       ->name('edit_message')
       ->middleware('can:messages.update, message');

  Route::put('/update/{id}', 'MessageController@update')
       ->name('update_message')
       ->middleware('can:messages.update, message');

  Route::delete('/destroy/{id}', 'MessageController@destroy')
       ->name('destroy_message')
       ->middleware('can:messages.delete, message');

  Route::get('/filter/{date?}', 'MessageController@filter')
       ->name('filter_message')
       ->middleware('can:messages.view, message');
});

Route::prefix('/call_trackings')->middleware('auth')->group(function ()
{
  Route::get('/', 'CallController@index')
       ->name('call_trackings')
       ->middleware('can:calls.view, App\Call');

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

  Route::put('/update/{id}', 'CallController@update')
       ->name('update_call')
       ->middleware('can:calls.update, call');

  Route::delete('/destroy/{id}', 'CallController@destroy')
       ->name('destroy_call')
       ->middleware('can:calls.delete, call');

  Route::get('/filter/{date?}', 'CallController@filter')
       ->name('filter_call')
       ->middleware('can:calls.view, call');
});

Route::prefix('/for_sales')->middleware('auth')->group(function ()
{
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

  Route::put('/update/{id}', 'SaleController@update')
       ->name('update_sale')
       ->middleware('can:sales.update, sale');

  Route::delete('/destroy/{id}', 'SaleController@destroy')
       ->name('destroy_sale')
       ->middleware('can:sales.delete, sale');

  Route::prefix('/{id}/edit_seller')->group(function ()
  {
    Route::get('/{seller_id}', 'SaleSellerController@edit')
         ->name('edit_seller')
         ->middleware('can:sale_sellers.view, sale_sellers');
    Route::put('/{seller_id}', 'SaleSellerController@update')
         ->name('edit_seller')
         ->middleware('can:sale_sellers.update, sale_sellers');
  });

  Route::prefix('/{id}/edit_closing_contract')->group(function ()
  {
    Route::get('/{closing_contract_id}', 'SaleClosingContractController@edit')
         ->name('edit_closing_contract')
         ->middleware('can:closing_contract.view, sale_closing_contracts');

    Route::put('/{closing_contract_id}', 'SaleClosingContractController@update')
         ->name('edit_closing_contract')
         ->middleware('can:closing_contract.edit, sale_closing_contracts');
  });

  Route::prefix('/{id}/edit_log')->group(function ()
  {
    Route::get('/{log_id}', 'SaleLogController@edit')
         ->name('edit_log')
         ->middleware('can:edit_log.view, sale_logs');

    Route::put('/{log_id}', 'SaleLogController@update')
         ->name('edit_log')
         ->middleware('can:edit_log.edit, sale_logs');
  });

  Route::prefix('/{id}/edit_contract')->group(function ()
  {
    Route::get('/{contract_id}', 'SaleContractController@edit')
         ->name('edit_contract')
         ->middleware('can:contract.view, sale_contracts');

    Route::put('/{contract_id}', 'SaleContractController@update')
         ->name('edit_contract')
         ->middleware('can:contract.edit, sale_contracts');
  });

  Route::prefix('/{id}/edit_notary')->group(function ()
  {
    Route::get('/{notary_id}', 'SaleNotaryController@edit')
         ->name('edit_notary')
         ->middleware('can:edit_notary.view, sale_notaries');

    Route::put('/{notary_id}', 'SaleNotaryController@update')
         ->name('edit_notary')
         ->middleware('can:edit_notary.edit, sale_notaries');
  });

  Route::prefix('/{id}/edit_signature')->group(function ()
  {
    Route::get('/{signature_id}', 'SaleSignatureController@edit')
         ->name('edit_signature')
         ->middleware('can:edit_signature.view, sale_signatures');

    Route::put('/{signature_id}', 'SaleSignatureController@update')
         ->name('edit_signature')
         ->middleware('can:edit_signature.edit, sale_signatures');
  });
});

Route::prefix('/internal_expedients')->middleware('auth')->group(function ()
{
  Route::post('/store', 'InternalExpedientController@store')
       ->name('store_internal_expedient');

  Route::put('/update/{id}', 'InternalExpedientController@update')
       ->name('update_internal_expedient');
});

Route::prefix('/mailable')->middleware('auth')->group(function ()
{
  Route::get('/message_created', function () {
    $messageCreated = App\Message::find(1);

    return new App\Mail\MessageCreated($messageCreated);
  });

  Route::get('/sale_created', function () {
    $saleCreated = App\Sale::find(1);

    return new App\Mail\SaleCreated($saleCreated);
  });
});
