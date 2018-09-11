<?php

namespace App\Http\Controllers;

use App\Notary;
use App\Sale;
use App\Client;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Carbon\Carbon as Carbon;

class NotaryController extends Controller
{
  use ThrottlesLogins;

  /**
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
    $SN_federal_entity = $request->SN_federal_entity;
    $SN_notaries_office = $request->SN_notaries_office;
    $SN_zoning = !empty($request->SN_zoning) ? $this->_date : null;
    $SN_water_no_due_constants = !empty($request->SN_water_no_due_constants) ? $this->_date : null;
    $SN_non_debit_proof_of_property = !empty($request->SN_non_debit_proof_of_property) ? $this->_date : null;
    $SN_certificate_of_improvement = !empty($request->SN_certificate_of_improvement) ? $this->_date : null;
    $SN_key_and_cadastral_value = !empty($request->SN_key_and_cadastral_value) ? $this->_date : null;
    $SN_date_freedom_of_lien_certificate = $request->SN_date_freedom_of_lien_certificate;
    $SN_observations_freedom_of_lien_certificate = $request->SN_observations_freedom_of_lien_certificate;
    $SN_seller_documents = !empty($request->SN_seller_documents) ? $this->_date : null;
    $SN_buyer_documents = !empty($request->SN_buyer_documents) ? $this->_date : null;
    $SN_activation_documents_for_the_mortgage_loan = !empty($request->SN_activation_documents_for_the_mortgage_loan) ? $this->_date : null;
    $SN_complete = (
      $SN_federal_entity !== null ||
      $SN_notaries_office !== null ||
      $SN_zoning !== null ||
      $SN_water_no_due_constants !== null ||
      $SN_non_debit_proof_of_property !== null ||
      $SN_certificate_of_improvement !== null ||
      $SN_key_and_cadastral_value !== null ||
      $SN_date_freedom_of_lien_certificate !== null ||
      $SN_observations_freedom_of_lien_certificate !== null ||
      $SN_seller_documents !== null ||
      $SN_buyer_documents !== null ||
      $SN_activation_documents_for_the_mortgage_loan !== null
    );
    $notaryInfo = [
      "SN_federal_entity" => $SN_federal_entity,
      "SN_notaries_office" => $SN_notaries_office,
      "SN_zoning" => $SN_zoning,
      "SN_water_no_due_constants" => $SN_water_no_due_constants,
      "SN_non_debit_proof_of_property" => $SN_non_debit_proof_of_property,
      "SN_certificate_of_improvement" => $SN_certificate_of_improvement,
      "SN_key_and_cadastral_value" => $SN_key_and_cadastral_value,
      "SN_date_freedom_of_lien_certificate" => $SN_date_freedom_of_lien_certificate,
      "SN_observations_freedom_of_lien_certificate" => $SN_observations_freedom_of_lien_certificate,
      "SN_seller_documents" => $SN_seller_documents,
      "SN_buyer_documents" => $SN_buyer_documents,
      "SN_activation_documents_for_the_mortgage_loan" => $SN_activation_documents_for_the_mortgage_loan,
      "SN_complete" => $SN_complete,
    ];
    $notary = $sale->notary()
                   ->update($notaryInfo);

    $this->_message = $notary
                        ? 'Compraventa actualizada'
                        : 'No se pudo actualizar la compraventa.';
    $this->_type = $notary ? 'success' : 'danger';

    if ($request->ajax())
    {
      return response()->json(['message' => $this->_message]);
    }
    else
    {
      if ($this->_type === 'success')
      {
        // event(new SaleCreatedEvent($sale));

        return redirect(route('sale.index'))
          ->withMessage($this->_message)
          ->withType($this->_type);
      }
      else
      {
        return redirect()
          ->back()
          ->withMessage($this->_message)
          ->withType($this->_type);
      }
    }
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
