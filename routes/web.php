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

Route::prefix('/client')->name('client.')->middleware('auth')->group(function ()
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

  Route::get('/show/{client}', 'ClientController@show')
       ->name('show')
       ->middleware('can:clients.view,client');

  Route::get('/edit/{client}', 'ClientController@edit')
       ->name('edit')
       ->middleware('can:clients.update,client');

  Route::put('/update/{client}', 'ClientController@update')
       ->name('update')
       ->middleware('can:clients.update,client');

  Route::delete('/destroy/{client}', 'ClientController@destroy')
       ->name('destroy')
       ->middleware('can:clients.delete,client');

  Route::get('/filter/{client?}', 'ClientController@filter')
        ->name('filter')
        ->middleware('can:clients.view,client');
});

Route::prefix('/message')->name('message.')->middleware('auth')->group(function ()
{
  Route::get('/', 'MessageController@index')
       ->name('index')
       ->middleware('can:message.view, App\Messages');

  Route::get('/new', 'MessageController@create')
       ->name('create')
       ->middleware('can:message.create,App\Message');

  Route::post('/store', 'MessageController@store')
       ->name('store')
       ->middleware('can:message.create,App\Message');

  Route::get('/show/{message}', 'MessageController@show')
       ->name('show')
       ->middleware('can:message.view,message');

  Route::get('/edit/{message}', 'MessageController@edit')
       ->name('edit')
       ->middleware('can:message.update,message');

  Route::put('/update/{message}', 'MessageController@update')
       ->name('update')
       ->middleware('can:message.update,message');

  Route::delete('/destroy/{message}', 'MessageController@destroy')
       ->name('destroy')
       ->middleware('can:message.delete,message');

  Route::get('/filter/{date?}', 'MessageController@filter')
       ->name('filter')
       ->middleware('can:message.view,App\Message');
});

Route::prefix('/call')->name('call.')->middleware('auth')->group(function ()
{
  Route::get('/', 'CallController@index')
       ->name('index')
       ->middleware('can:call.view,App\Call');

  Route::get('/new', 'CallController@create')
       ->name('create')
       ->middleware('can:call.create,App\Call');

  Route::post('/store', 'CallController@store')
       ->name('store')
       ->middleware('can:call.create,App\Call');

  Route::get('/show/{call}', 'CallController@show')
       ->name('show')
       ->middleware('can:call.view,App\Call');

  Route::get('/edit/{call}', 'CallController@edit')
       ->name('edit')
       ->middleware('can:call.update,call');

  Route::put('/update/{call}', 'CallController@update')
       ->name('update')
       ->middleware('can:call.update,call');

  Route::delete('/destroy/{call}', 'CallController@destroy')
       ->name('destroy')
       ->middleware('can:call.delete,call');

  Route::get('/filter/{date?}', 'CallController@filter')
       ->name('filter')
       ->middleware('can:call.view,App\Call');
});

Route::prefix('/sale')->name('sale.')->middleware('auth')->group(function ()
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

  Route::delete('/destroy/{sale}', 'SaleController@destroy')
       ->name('destroy')
       ->middleware('can:sales.delete, sale');

  Route::prefix('/{sale}/seller')->name('seller.')->group(function ()
  {
    Route::get('/{seller}', 'SellerController@edit')
         ->name('edit')
         ->middleware('can:seller.view,seller');
    Route::put('/{seller}', 'SellerController@update')
         ->name('update')
         ->middleware('can:seller.update,seller');
  });

  Route::prefix('/{sale}/closing_contract')->name('closing_contract.')->group(function ()
  {
    Route::get('/{closing_contract}', 'ClosingContractController@edit')
         ->name('edit')
         ->middleware('can:closing_contract.view,closing_contract');

    Route::put('/{closing_contract}', 'ClosingContractController@update')
         ->name('update')
         ->middleware('can:closing_contract.update,closing_contract');
  });

  Route::prefix('/{sale}/visit')->name('visit.')->group(function ()
  {
    Route::get('/{visit_id}', 'VisitController@edit')
         ->name('edit')
         ->middleware('can:visit.view,visit');

    Route::put('/{visit_id}', 'VisitController@update')
         ->name('update')
         ->middleware('can:visit.update,visit');
  });

  Route::prefix('/{sale}/contract')->name('contract.')->group(function ()
  {
    Route::get('/{contract}', 'ContractController@edit')
         ->name('edit')
         ->middleware('can:contract.view,contract');

    Route::put('/{contract}', 'ContractController@update')
         ->name('update')
         ->middleware('can:contract.update,contract');
  });

  Route::prefix('/{sale}/notary')->name('notary.')->group(function ()
  {
    Route::get('/{notary}', 'NotaryController@edit')
         ->name('edit')
         ->middleware('can:notary.view,notary');

    Route::put('/{notary}', 'NotaryController@update')
         ->name('update')
         ->middleware('can:notary.update,notary');
  });

  Route::prefix('/{sale}/signature')->name('signature.')->group(function ()
  {
    Route::get('/{signature}', 'SignatureController@edit')
         ->name('edit')
         ->middleware('can:signature.view,signature');

    Route::put('/{signature}', 'SignatureController@update')
         ->name('update')
         ->middleware('can:signature.update,signature');
  });
});

Route::prefix('/internal_expedient')->name('internal_expedient.')->middleware('auth')->group(function ()
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
