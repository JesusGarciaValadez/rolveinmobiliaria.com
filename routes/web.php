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

Route::prefix('/clients')->name('client.')->middleware('auth')->group(function ()
{
  Route::get('/', 'ClientController@index')
       ->name('index')
       ->middleware('can:clients.view, App\Client');

  Route::get('/new', 'ClientController@create')
       ->name('create')
       ->middleware('can:clients.create, App\Client');

  Route::post('/store', 'ClientController@store')
       ->name('store')
       ->middleware('can:clients.create, client');

  Route::get('/show/{id}', 'ClientController@show')
       ->name('show')
       ->middleware('can:clients.view, client');

  Route::get('/edit/{id}', 'ClientController@edit')
       ->name('edit')
       ->middleware('can:clients.update, client');

  Route::put('/update/{id}', 'ClientController@update')
       ->name('update')
       ->middleware('can:clients.update, client');

  Route::delete('/destroy/{id}', 'ClientController@destroy')
       ->name('destroy')
       ->middleware('can:clients.delete, client');

  Route::get('/filter/{parameter?}', 'ClientController@filter')
        ->name('filter')
        ->middleware('can:clients.view, client');
});

Route::prefix('/messages')->name('message.')->middleware('auth')->group(function ()
{
  Route::get('/', 'MessageController@index')
       ->name('index')
       ->middleware('can:messages.view, App\Messages');

  Route::get('/new', 'MessageController@create')
       ->name('create')
       ->middleware('can:messages.create, App\Message');

  Route::post('/store', 'MessageController@store')
       ->name('store')
       ->middleware('can:messages.create, message');

  Route::get('/show/{id}', 'MessageController@show')
       ->name('show')
       ->middleware('can:messages.view, message');

  Route::get('/edit/{id}', 'MessageController@edit')
       ->name('edit')
       ->middleware('can:messages.update, message');

  Route::put('/update/{id}', 'MessageController@update')
       ->name('update')
       ->middleware('can:messages.update, message');

  Route::delete('/destroy/{id}', 'MessageController@destroy')
       ->name('destroy')
       ->middleware('can:messages.delete, message');

  Route::get('/filter/{date?}', 'MessageController@filter')
       ->name('filter')
       ->middleware('can:messages.view, message');
});

Route::prefix('/call_trackings')->name('call_tracking.')->middleware('auth')->group(function ()
{
  Route::get('/', 'CallController@index')
       ->name('index')
       ->middleware('can:calls.view, App\Call');

  Route::get('/new', 'CallController@create')
       ->name('create')
       ->middleware('can:calls.create, App\Call');

  Route::post('/store', 'CallController@store')
       ->name('store')
       ->middleware('can:calls.create, call');

  Route::get('/show/{id}', 'CallController@show')
       ->name('show')
       ->middleware('can:calls.view, call');

  Route::get('/edit/{id}', 'CallController@edit')
       ->name('edit')
       ->middleware('can:calls.update, call');

  Route::put('/update/{id}', 'CallController@update')
       ->name('update')
       ->middleware('can:calls.update, call');

  Route::delete('/destroy/{id}', 'CallController@destroy')
       ->name('destroy')
       ->middleware('can:calls.delete, call');

  Route::get('/filter/{date?}', 'CallController@filter')
       ->name('filter')
       ->middleware('can:calls.view, call');
});

Route::prefix('/for_sales')->name('for_sale.')->middleware('auth')->group(function ()
{
  Route::get('/', 'SaleController@index')
       ->name('index')
       ->middleware('can:sales.view, App\Sale');

  Route::get('/new', 'SaleController@create')
       ->name('create')
       ->middleware('can:sales.create, App\Sale');

  Route::post('/store', 'SaleController@store')
       ->name('store')
       ->middleware('can:sales.create, sale');

  Route::get('/show/{id}', 'SaleController@show')
       ->name('show')
       ->middleware('can:sales.view, sale');

  Route::get('/edit/{id}', 'SaleController@edit')
       ->name('edit')
       ->middleware('can:sales.update, update');

  Route::put('/update/{id}', 'SaleController@update')
       ->name('update')
       ->middleware('can:sales.update, sale');

  Route::delete('/destroy/{id}', 'SaleController@destroy')
       ->name('destroy')
       ->middleware('can:sales.delete, sale');

  Route::prefix('/{id}/edit_seller')->name('seller.')->group(function ()
  {
    Route::get('/{seller_id}', 'SaleSellerController@show')
         ->name('show')
         ->middleware('can:sale_sellers.view, sale_sellers');
    Route::put('/{seller_id}', 'SaleSellerController@update')
         ->name('update')
         ->middleware('can:sale_sellers.update, sale_sellers');
  });

  Route::prefix('/{id}/edit_closing_contract')->name('closing_contract.')->group(function ()
  {
    Route::get('/{closing_contract_id}', 'SaleClosingContractController@show')
         ->name('show')
         ->middleware('can:sale_closing_contracts.view, sale_closing_contracts');

    Route::put('/{closing_contract_id}', 'SaleClosingContractController@update')
         ->name('update')
         ->middleware('can:sale_closing_contracts.update, sale_closing_contracts');
  });

  Route::prefix('/{id}/edit_log')->name('log.')->group(function ()
  {
    Route::get('/{log_id}', 'SaleLogController@show')
         ->name('show')
         ->middleware('can:edit_log.view, sale_logs');

    Route::put('/{log_id}', 'SaleLogController@update')
         ->name('update')
         ->middleware('can:edit_log.update, sale_logs');
  });

  Route::prefix('/{id}/edit_contract')->name('contract.')->group(function ()
  {
    Route::get('/{contract_id}', 'SaleContractController@show')
         ->name('show')
         ->middleware('can:contract.view, sale_contracts');

    Route::put('/{contract_id}', 'SaleContractController@update')
         ->name('update')
         ->middleware('can:contract.update, sale_contracts');
  });

  Route::prefix('/{id}/edit_notary')->name('notary.')->group(function ()
  {
    Route::get('/{notary_id}', 'SaleNotaryController@show')
         ->name('show')
         ->middleware('can:edit_notary.view, sale_notaries');

    Route::put('/{notary_id}', 'SaleNotaryController@update')
         ->name('update')
         ->middleware('can:edit_notary.update, sale_notaries');
  });

  Route::prefix('/{id}/edit_signature')->name('signature.')->group(function ()
  {
    Route::get('/{signature_id}', 'SaleSignatureController@show')
         ->name('show')
         ->middleware('can:edit_signature.view, sale_signatures');

    Route::put('/{signature_id}', 'SaleSignatureController@update')
         ->name('update')
         ->middleware('can:edit_signature.update, sale_signatures');
  });
});

Route::prefix('/internal_expedients')->name('internal_expedient.')->middleware('auth')->group(function ()
{
  Route::post('/store', 'InternalExpedientController@store')
       ->name('store');

  Route::put('/update/{id}', 'InternalExpedientController@update')
       ->name('update');
});

Route::prefix('/mailable')->name('mailable.')->middleware('auth')->group(function ()
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
