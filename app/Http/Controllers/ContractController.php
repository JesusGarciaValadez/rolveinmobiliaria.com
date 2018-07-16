<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Sale;
use App\Client;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\ThrottlesLogins;

use App\Http\Requests\ContractRequest;

class ContractController extends Controller
{
  use ThrottlesLogins;

  /*
   * Set the uri returned to views.
   *
   * @var string
   */
  private $_uri = 'sale';

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
   * @param  \App\Contract  $contract
   * @return \Illuminate\Http\Response
   */
  public function show(Sale $sale, Contract $contract)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Sale  $sale
   * @param  \App\Contract  $contract
   * @return \Illuminate\Http\Response
   */
  public function edit(Sale $sale, Contract $contract)
  {
    $clients = Client::all();

    return view('sales.edit_contract')
            ->withUri($this->_uri)
            ->withSale($sale)
            ->withClients($clients);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\ContractRequest  $request
   * @param  \App\Sale  $sale
   * @param  \App\Contract  $contract
   * @return \Illuminate\Http\Response
   */
  public function update(ContractRequest $request, Sale $sale, Contract $contract)
  {
    dd($request);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Sale  $sale
   * @param  \App\Contract  $contract
   * @return \Illuminate\Http\Response
   */
  public function destroy(Sale $sale, Contract $contract)
  {
    //
  }
}
