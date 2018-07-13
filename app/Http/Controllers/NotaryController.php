<?php

namespace App\Http\Controllers;

use App\Notary;
use App\Sale;
use App\Client;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Carbon\Carbon as Carbon;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Auth as Auth;
use App\Http\Requests\ClosingContractRequest;
use App\Events\FileWillUploadEvent;

class NotaryController extends Controller
{
  use ThrottlesLogins;

  /**
   * Set the uri returned to views.
   *
   * @var string
   */
  private $_uri = 'for_sales';

  /**
   * Set the localization for the language in the app.
   *
   * @var string
   */
  private $_locale;

  /**
   * Set the message to the used returned to views.
   *
   * @var string
   */
  private $_message = null;

  /**
   * File uploaded
   *
   * @var string
   */
  private $_file = null;

  /**
   * Set the type of the alarm return to views.
   *
   * @var string
   */
  private $_type = null;

  /**
   * Date of the attribute updated or created.
   *
   * @var string
   */
  private $_date = null;

  public function __constructor ()
  {
    $this->_locale = \App::getLocale();
  }

  /**
   * Display a listing of the resource.
   *
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function index(Sale $sale)
  {
      //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function create(Sale $sale)
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Sale $sale)
  {
      //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Sale  $sale
   * @param  \App\Notary  $notary
   * @return \Illuminate\Http\Response
   */
  public function show(Sale $sale, Notary $notary)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Sale  $sale
   * @param  \App\Notary  $notary
   * @return \Illuminate\Http\Response
   */
  public function edit(Sale $sale, Notary $notary)
  {
    dd('Hola');
    $sale = Sale::findOrFail($id);
    $clients = Client::all();

    return view('sales.edit_notary')
            ->withUri($this->_uri)
            ->withSale($sale)
            ->withClients($clients);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Sale  $sale
   * @param  \App\Notary  $notary
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Sale $sale, Notary $notary)
  {
    $this->_date = Carbon::now('America/Mexico_City')->toDateString();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Sale  $sale
   * @param  \App\Notary  $notary
   * @return \Illuminate\Http\Response
   */
  public function destroy(Sale $sale, Notary $notary)
  {
      //
  }
}
