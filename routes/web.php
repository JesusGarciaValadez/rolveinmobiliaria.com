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

  Route::prefix('/{id}/seller')->name('seller.')->group(function ()
  {
    Route::get('/{seller_id}', 'SellerController@edit')
         ->name('edit')
         ->middleware('can:sellers.view, sellers');
    Route::put('/{seller_id}', 'SellerController@update')
         ->name('update')
         ->middleware('can:sellers.update, sellers');
  });

  Route::prefix('/{id}/closing_contract')->name('closing_contract.')->group(function ()
  {
    Route::get('/{closing_contract_id}', 'ClosingContractController@edit')
         ->name('edit')
         ->middleware('can:closing_contracts.view, closing_contracts');

    Route::put('/{closing_contract_id}', 'ClosingContractController@update')
         ->name('update')
         ->middleware('can:closing_contracts.update, closing_contracts');
  });

  Route::prefix('/{id}/visit')->name('visit.')->group(function ()
  {
    Route::get('/{visit_id}', 'VisitController@edit')
         ->name('edit')
         ->middleware('can:sale_visits.view, sale_visits');

    Route::put('/{visit_id}', 'VisitController@update')
         ->name('update')
         ->middleware('can:sale_visits.update, sale_visits');
  });

  Route::prefix('/{id}/contract')->name('contract.')->group(function ()
  {
    Route::get('/{contract_id}', 'ContractController@edit')
         ->name('edit')
         ->middleware('can:contracts.view, contracts');

    Route::put('/{contract_id}', 'ContractController@update')
         ->name('update')
         ->middleware('can:contracts.update, contracts');
  });

  Route::prefix('/{id}/notary')->name('notary.')->group(function ()
  {
    Route::get('/{notary}', 'NotaryController@edit')
         ->name('edit')
         ->middleware('can:notaries.view, notary');

    Route::put('/{notary}', 'NotaryController@update')
         ->name('update')
         ->middleware('can:notaries.update, notary');
  });

  Route::prefix('/{id}/signature')->name('signature.')->group(function ()
  {
    Route::get('/{signature_id}', 'SignatureController@edit')
         ->name('edit')
         ->middleware('can:signatures.view, signatures');

    Route::put('/{signature_id}', 'SignatureController@update')
         ->name('update')
         ->middleware('can:signatures.update, signatures');
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
