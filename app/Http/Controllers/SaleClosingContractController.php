<?php

namespace App\Http\Controllers;

use App\SaleClosingContract;
use App\Sale;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Carbon\Carbon as Carbon;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Auth as Auth;

class SaleClosingContractController extends Controller
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
   * @param  \App\SaleClosingContract  $saleClosingContract
   * @return \Illuminate\Http\Response
   */
  public function show(Sale $sale, SaleClosingContract $saleClosingContract)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Sale  $sale
   * @param  \App\SaleClosingContract  $saleClosingContract
   * @return \Illuminate\Http\Response
   */
  public function edit($id, $closingContractId, Sale $sale, SaleClosingContract $saleClosingContract)
  {
    $sale = Sale::findOrFail($id);
    $clients = Client::all();

    return view('sales.edit_closing_contract')
            ->withUri($this->_uri)
            ->withSale($sale)
            ->withClients($clients);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Sale  $sale
   * @param  \App\SaleClosingContract  $saleClosingContract
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Sale $sale, SaleClosingContract $saleClosingContract)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Sale  $sale
   * @param  \App\SaleClosingContract  $saleClosingContract
   * @return \Illuminate\Http\Response
   */
  public function destroy(Sale $sale, SaleClosingContract $saleClosingContract)
  {
      //
  }
}
