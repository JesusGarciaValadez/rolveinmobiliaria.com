<?php

namespace App\Http\Controllers;

use App\Sale;
use App\State;
use App\Client;
use App\InternalExpedient;
use App\User;
use App\Seller;
use App\ClosingContract;
use App\Visit;
use App\Contract;
use App\Notary;
use App\Signature;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\SellerRequest;

/**
 * Events
 */
use App\Events\SaleCreatedEvent;
use App\Events\FileWillUpload;

class SaleController extends Controller
{
  use ThrottlesLogins;

  private $_uri = 'sale';
  private $_locale;

  private $_expedients;
  private $_clients;
  private $_internal_expedient_id;
  // Sellers
  private $_seller;
  //Date
  private $_date;
  // File uploaded
  private $_file;
  private $_sellers_id;
  private $_message;
  private $_type;

  public function __construct ()
  {
    $this->_locale = \App::getLocale();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index ()
  {
    $sales = Sale::orderBy('id', 'desc')->get();

    return view('sales.index', [
      'sales'  => $sales,
      'uri'    => $this->_uri,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create ()
  {
    $currentUser = User::with('role')->find(Auth::id());

    if (
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    )
    {
      $expedients = InternalExpedient::with('client')
                      ->get()
                      ->sortBy('expedient');
      $clients = Client::all()
                  ->sortBy('last_name')
                  ->sortBy('first_name');
    }
    else
    {
      $expedients = InternalExpedient::with('client')
                      ->where('user_id', Auth::id())
                      ->get()
                      ->sortBy('expedient');
      $clients = Client::where('user_id', Auth::id())
                  ->get()
                  ->sortBy('last_name')
                  ->sortBy('first_name');
    }

    $states = State::all();

    return view('sales.create_seller', [
      'states'       => $states,
      'expedients'   => $expedients,
      'clients'      => $clients,
      'uri'          => $this->_uri,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\SellerRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store (SellerRequest $request)
  {
    $this->_date = Carbon::create()->format('U');

    $this->_user_id = User::with('role')->find(Auth::id())->id;
    $this->_internal_expedient_id = $request->internal_expedient_id;
    $this->_seller = $this->_setSellerVariables($request);

    // Creation of seller information
    $this->_sellerCreated = Seller::create($this->_seller);
    $this->_sellers_id = $this->_sellerCreated
                          ? $this->_sellerCreated->id
                          : null;

    // Creation of closing contract in null
    $closingContractCreatedID = ClosingContract::create([
      'SCC_commercial_valuation' => null,
      'SCC_exclusivity_contract' => null,
      'SCC_publication' => null,
      'SCC_data_sheet' => null,
      'SCC_closing_contract_observations' => null,
      'SCC_complete' => false,
    ]);
    $closingContractId = $closingContractCreatedID
                          ? $closingContractCreatedID->id
                          : null;

    // Creation of contract in null
    $contractCreatedID = Contract::create([
      'SC_mortgage_broker' => null,
      'SC_contract_with_the_broker' => null,
      'SC_mortgage_credit'  => null,
      'SC_general_buyer' => null,
      'SC_purchase_agreements' => null,
      'SC_tax_assessment' => null,
      'SC_notary_checklist' => null,
      'SC_notary_file' => null,
      'SC_complete' => null,
    ]);
    $contractId = $contractCreatedID ? $contractCreatedID->id : null;

    // Creation of notary in null
    $notaryCreatedID = Notary::create([
      'SN_federal_entity' => null,
      'SN_notaries_office' => null,
      'SN_freedom_of_lien_certificate' => null,
      'SN_zoning' => null,
      'SN_water_no_due_constants' => null,
      'SN_non_debit_proof_of_property' => null,
      'SN_certificate_of_improvement' => null,
      'SN_key_and_cadastral_value' => null,
      'SN_complete' => false,
    ]);
    $notaryId = $notaryCreatedID ? $notaryCreatedID->id : null;

    // Creation of notary in null
    $signatureCreatedID = Signature::create([
      'SS_writing_review' => null,
      'SS_scheduled_date_of_writing_signature' => null,
      'SS_scheduled_payment_date' => null,
      'SS_payment_made' => null,
      'SS_complete' => false,
    ]);
    $signatureId = $signatureCreatedID ? $signatureCreatedID->id : null;

    $sale = new Sale([
      'internal_expedients_id' => $this->_internal_expedient_id,
      'sale_sellers_id' => $this->_sellers_id,
      'sale_closing_contracts_id' => $closingContractId,
      'sale_contracts_id' => $contractId,
      'sale_notaries_id' => $notaryId,
      'sale_signatures_id' => $signatureId,
      'user_id' => $this->_user_id
    ]);

    $saleSaved = $sale->save();

    $this->_message = $saleSaved ? 'Compraventa añadida' : 'No se pudo añadir la compraventa.';
    $this->_type = $saleSaved ? 'success' : 'danger';

    if (empty($this->_message))
    {
      $this->_message = ($this->_sellerCreated || $this->_closingContractCreated)
        ? 'La compraventa fue creada.'
        : 'No se pudo crear la compraventa.';
    }

    if (empty($this->_type))
    {
      $this->_type = ($this->_sellerCreated || $this->_closingContractCreated)
        ? 'success'
        : 'danger';
    }

    $request->session()->flash('message', $this->_message);
    $request->session()->flash('type', $this->_type);

    if ($saleSaved)
    {
      event(new SaleCreatedEvent($sale));

      return redirect()->route('sale.index');
    }
    else
    {
      return redirect()->back()->withInput();
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function show (Sale $sale, Request $request)
  {
    $sale = Sale::findOrFail($request->id);

    return view('sales.show', [
      'sale' => $sale,
      'uri'  => $this->_uri,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function edit (Sale $sale, Request $request)
  {
    $states = State::all();

    $sale = Sale::findOrFail($request->id);

    $clients = Client::all()
                ->sortBy('last_name')
                ->sortBy('first_name');


    return view('sales.edit', [
      'states'    => $states,
      'sale'      => $sale,
      'clients'   => $clients,
      'uri'       => $this->_uri,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\SaleRequest  $request
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function update (SaleRequest $request, Sale $sale)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function destroy (Sale $sale, Request $request)
  {
    $destroyed = $sale->delete();

    $this->_message = ($destroyed)
      ? 'Llamada eliminada'
      : 'No se pudo eliminar la llamada.';
    $this->_type = ($destroyed) ? 'success' : 'danger';
    $request->session()->flash('message', $this->_message);
    $request->session()->flash('type', $this->_type);

    return redirect()->route('sale.index');
  }

  private function _setClosingContractVariables (Request $request)
  {
    if ($request->hasFile('SCC_data_sheet') && $request->file('SCC_data_sheet')->isValid())
    {
      if (
        $request->file('SCC_data_sheet')->extension() === 'pdf' ||
        $request->file('SCC_data_sheet')->extension() === 'doc' ||
        $request->file('SCC_data_sheet')->extension() === 'docx'
      )
      {
        $this->_file = !empty(event(new FileWillUpload($request->file('SCC_data_sheet'))))
                          ? event(new FileWillUpload($request->file('SCC_data_sheet')))[0]
                          : null;
      }
      else
      {
        $this->_message = 'El archivo no puede ser subido porque no es un tipo de archivo válido para subir';
        $this->_type = 'danger';
      }
    }
    else
    {
      $this->_file = $request->SCC_data_sheet_exists;
    }

    $SCC_commercial_valuation = !empty($request->SCC_commercial_valuation)
                                  ? $this->_date
                                  : null;
    $SCC_exclusivity_contract = !empty($request->SCC_exclusivity_contract)
                                  ? $this->_date
                                  : null;
    $SCC_publication = !empty($request->SCC_publication)
                          ? $this->_date
                          : null;
    $SCC_data_sheet = $this->_file;
    $SCC_closing_contract_observations = !empty($request->SCC_closing_contract_observations)
                                            ? $request->SCC_closing_contract_observations
                                            : null;
    $SCC_complete = (
      $SCC_commercial_valuation &&
      $SCC_exclusivity_contract &&
      $SCC_publication &&
      $SCC_data_sheet &&
      $SCC_closing_contract_observations
    )
      ? true
      : false;

    return [
      'SCC_commercial_valuation' => $SCC_commercial_valuation,
      'SCC_exclusivity_contract' => $SCC_exclusivity_contract,
      'SCC_publication' => $SCC_publication,
      'SCC_data_sheet' => $SCC_data_sheet,
      'SCC_closing_contract_observations' => $SCC_closing_contract_observations,
      'SCC_complete' => $SCC_complete
    ];
  }
}
