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
      $currentUser->hasRole(\App\Enums\RoleType::SUPER_ADMIN) ||
      $currentUser->hasRole(\App\Enums\RoleType::ADMIN)
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
    $this->_date = now()->format('U');

    $this->_user_id = User::with('role')->find(Auth::id())->id;
    $this->_internal_expedient_id = $request->internal_expedient_id;
    $this->_seller = $this->_setSellerVariables($request);

    // Creation of seller information
    $this->_sellerCreated = Seller::create($this->_seller);
    $this->_sellerCreated->save();
    $this->_sellers_id = $this->_sellerCreated->id;

    // Creation of closing contract in null
    $closingContractCreated = ClosingContract::create([
      'SCC_commercial_valuation' => null,
      'SCC_exclusivity_contract' => null,
      'SCC_publication' => null,
      'SCC_data_sheet' => null,
      'SCC_closing_contract_observations' => null,
      'SCC_complete' => false,
    ]);
    $closingContractCreated->save();
    $closingContractId = $closingContractCreated->id;

    // Creation of contract in null
    $contractCreated = Contract::create([
      'SC_mortgage_broker' => null,
      'SC_contract_with_the_broker' => null,
      'SC_mortgage_credit'  => null,
      'SC_general_buyer' => null,
      'SC_purchase_agreements' => null,
      'SC_tax_assessment' => null,
      'SC_notary_checklist' => null,
      'SC_notary_file' => null,
      'SC_complete' => false,
    ]);
    $contractCreated->save();
    $contractId = $contractCreated->id;

    // Creation of notary in null
    $notaryCreated = Notary::create([
      'SN_federal_entity' => \App\Enums\FederalEntity::CDMX,
      'SN_notaries_office' => null,
      'SN_freedom_of_lien_certificate' => null,
      'SN_zoning' => null,
      'SN_water_no_due_constants' => null,
      'SN_non_debit_proof_of_property' => null,
      'SN_certificate_of_improvement' => null,
      'SN_key_and_cadastral_value' => null,
      'SN_complete' => false,
    ]);
    $notaryCreated->save();
    $notaryId = $notaryCreated->id;

    // Creation of notary in null
    $signatureCreated = Signature::create([
      'SS_writing_review' => null,
      'SS_scheduled_date_of_writing_signature' => null,
      'SS_scheduled_payment_date' => null,
      'SS_payment_made' => null,
      'SS_complete' => false,
    ]);
    $signatureCreated->save();
    $signatureId = $signatureCreated->id;

    $sale = Sale::create([
      'internal_expedients_id' => $this->_internal_expedient_id,
      'sellers_id' => $this->_sellers_id,
      'closing_contracts_id' => $closingContractId,
      'contracts_id' => $contractId,
      'notaries_id' => $notaryId,
      'signatures_id' => $signatureId,
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

  private function _setSellerVariables (Request $request)
  {
    $SD_deed = !empty($request->SD_deed)
      ? $this->_date
      : null;
    $SD_water = !empty($request->SD_water)
      ? $this->_date
      : null;
    $SD_predial = !empty($request->SD_predial)
      ? $this->_date
      : null;
    $SD_light = !empty($request->SD_light)
      ? $this->_date
      : null;
    $SD_birth_certificate = !empty($request->SD_birth_certificate)
      ? $this->_date
      : null;
    $SD_ID = !empty($request->SD_ID)
      ? $this->_date
      : null;
    $SD_CURP = !empty($request->SD_CURP)
      ? $request->SD_CURP
      : null;
    $SD_RFC = !empty($request->SD_RFC)
      ? $request->SD_RFC
      : null;
    $SD_account_status = !empty($request->SD_account_status)
      ? $this->_date
      : null;
    $SD_email = !empty($request->SD_email)
      ? $this->_date
      : null;
    $SD_phone = !empty($request->SD_phone)
      ? $this->_date
      : null;
    $SD_civil_status = !empty($request->SD_civil_status)
      ? $request->SD_civil_status
      : 'Soltero';
    $SD_complete = (
      $SD_deed &&
      $SD_water &&
      $SD_predial &&
      $SD_light &&
      $SD_birth_certificate &&
      $SD_ID &&
      $SD_CURP &&
      $SD_RFC &&
      $SD_account_status &&
      $SD_email &&
      $SD_phone &&
      $SD_civil_status
    )
      ? true
      : false;

    return [
      'SD_deed' => $SD_deed,
      'SD_water' => $SD_water,
      'SD_predial' => $SD_predial,
      'SD_light' => $SD_light,
      'SD_birth_certificate' => $SD_birth_certificate,
      'SD_ID' => $SD_ID,
      'SD_CURP' => $SD_CURP,
      'SD_RFC' => $SD_RFC,
      'SD_account_status' => $SD_account_status,
      'SD_email' => $SD_email,
      'SD_phone' => $SD_phone,
      'SD_civil_status' => $SD_civil_status,
      'SD_complete' => $SD_complete
    ];
  }

  private function _setClosingContractVariables (Request $request)
  {
    if ($request->hasFile('SCC_data_sheet') && $request->file('SCC_data_sheet')->isValid())
    {
      if (
        $request->file('SCC_data_sheet')->extension() === \App\Enums\FileExtensionType::PDF ||
        $request->file('SCC_data_sheet')->extension() === \App\Enums\FileExtensionType::DOC ||
        $request->file('SCC_data_sheet')->extension() === \App\Enums\FileExtensionType::DOCX
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

  private function _setContractVariables (Request $request)
  {
    $SC_general_buyer = !empty($request->SC_general_buyer)
                          ? $this->_date
                          : null;
    $SC_purchase_agreements = !empty($request->SC_purchase_agreements)
                                ? $this->_date
                                : null;
    $SC_tax_assessment = !empty($request->SC_tax_assessment)
                            ? $this->_date
                            : null;
    $SC_notary_checklist = !empty($request->SC_notary_checklist)
                              ? $this->_date
                              : null;
    $SC_notary_file = !empty($request->SC_notary_file)
                        ? $this->_date
                        : null;
    $SC_mortgage_credit = !empty($request->SC_mortgage_credit)
                            ? $request->SC_mortgage_credit
                            : null;
    $SC_mortgage_broker = !empty($request->SC_mortgage_broker)
                            ? $this->_date
                            : null;
    $SC_contract_with_the_broker = !empty($request->SC_contract_with_the_broker)
                                      ? $this->_date
                                      : null;
    $SC_complete = (
      $SC_general_buyer &&
      $SC_purchase_agreements &&
      $SC_tax_assessment &&
      $SC_notary_checklist &&
      $SC_notary_file &&
      $SC_mortgage_credit
    )
      ? true
      : false;

    return [
      'SC_general_buyer' => $SC_general_buyer,
      'SC_purchase_agreements' => $SC_purchase_agreements,
      'SC_tax_assessment' => $SC_tax_assessment,
      'SC_notary_checklist' => $SC_notary_checklist,
      'SC_notary_file' => $SC_notary_file,
      'SC_mortgage_credit' => $SC_mortgage_credit,
      'SC_mortgage_broker' => $SC_mortgage_broker,
      'SC_contract_with_the_broker' => $SC_contract_with_the_broker,
      'SC_complete' => $SC_complete
    ];
  }

  private function _setInfonavitContractVariables (Request $request)
  {
    $IC_certified_birth_certificate = !empty($request->IC_certified_birth_certificate)
                                        ? $this->_date
                                        : null;
    $IC_official_ID = !empty($request->IC_official_ID)
                        ? $this->_date
                        : null;
    $IC_curp = !empty($request->IC_curp)
                  ? $this->_date
                  : null;
    $IC_rfc = !empty($request->IC_rfc)
                ? $this->_date
                : null;
    $IC_credit_simulator = !empty($request->IC_credit_simulator)
                              ? $this->_date
                              : null;
    $IC_credit_application = !empty($request->IC_credit_application)
                                ? $this->_date
                                : null;
    $IC_tax_valuation = !empty($request->IC_tax_valuation)
                          ? $this->_date
                          : null;
    $IC_bank_statement = !empty($request->IC_bank_statement)
                            ? $this->_date
                            : null;
    $IC_workshop_knowing_how_to_decide = !empty($request->IC_workshop_knowing_how_to_decide)
                                            ? $this->_date
                                            : null;
    $IC_retention_sheet = !empty($request->IC_retention_sheet)
                            ? $this->_date
                            : null;
    $IC_credit_activation = !empty($request->IC_credit_activation)
                              ? $this->_date
                              : null;
    $IC_credit_maturity = !empty($request->IC_credit_maturity)
                            ? $this->_date
                            : null;
    $IC_type = !empty($request->IC_type)
                  ? $request->IC_type
                  : null;
    $IC_spouses_birth_certificate = !empty($request->IC_spouses_birth_certificate)
                                      ? $this->_date
                                      : null;
    $IC_official_identification_of_the_spouse = !empty($request->IC_official_identification_of_the_spouse)
                                                  ? $this->_date
                                                  : null;
    $IC_marriage_certificate = !empty($request->IC_marriage_certificate)
                                  ? $this->_date
                                  : null;
    $IC_complete = (
      $IC_certified_birth_certificate &&
      $IC_official_ID &&
      $IC_curp &&
      $IC_rfc &&
      $IC_credit_simulator &&
      $IC_credit_application &&
      $IC_tax_valuation &&
      $IC_bank_statement &&
      $IC_workshop_knowing_how_to_decide &&
      $IC_retention_sheet &&
      $IC_credit_activation &&
      $IC_credit_maturity &&
      $IC_type
    )
      ? true
      : false;

    return [
      'IC_certified_birth_certificate' => $IC_certified_birth_certificate,
      'IC_official_ID' => $IC_official_ID,
      'IC_curp' => $IC_curp,
      'IC_rfc' => $IC_rfc,
      'IC_credit_simulator' => $IC_credit_simulator,
      'IC_credit_application' => $IC_credit_application,
      'IC_tax_valuation' => $IC_tax_valuation,
      'IC_bank_statement' => $IC_bank_statement,
      'IC_workshop_knowing_how_to_decide' => $IC_workshop_knowing_how_to_decide,
      'IC_retention_sheet' => $IC_retention_sheet,
      'IC_credit_activation' => $IC_credit_activation,
      'IC_credit_maturity' => $IC_credit_maturity,
      'IC_type' => $IC_type,
      'IC_spouses_birth_certificate' => $IC_spouses_birth_certificate,
      'IC_official_identification_of_the_spouse' => $IC_official_identification_of_the_spouse,
      'IC_marriage_certificate' => $IC_marriage_certificate,
      'IC_complete' => $IC_complete
    ];
  }

  private function _setFovisssteContractVariables (Request $request)
  {
    $FC_credit_simulator = !empty($request->FC_credit_simulator)
                              ? $this->_date
                              : null;
    $FC_curp = !empty($request->FC_curp)
                  ? $this->_date
                  : null;
    $FC_birth_certificate = !empty($request->FC_birth_certificate)
                                ? $this->_date
                                : null;
    $FC_bank_statement = !empty($request->FC_bank_statement)
                            ? $this->_date
                            : null;
    $FC_single_key_housing_payment = !empty($request->FC_single_key_housing_payment)
                                        ? $this->_date
                                        : null;
    $FC_general_buyers_and_sellers = !empty($request->FC_general_buyers_and_sellers)
                                        ? $this->_date
                                        : null;
    $FC_education_course = !empty($request->FC_education_course)
                              ? $this->_date
                              : null;
    $FC_last_pay_stub = !empty($request->FC_last_pay_stub)
                            ? $this->_date
                            : null;
    $FC_complete = (
      $FC_credit_simulator &&
      $FC_curp &&
      $FC_birth_certificate &&
      $FC_bank_statement &&
      $FC_single_key_housing_payment &&
      $FC_general_buyers_and_sellers &&
      $FC_education_course &&
      $FC_last_pay_stub
    )
      ? true
      : false;

    return [
      'FC_credit_simulator' => $FC_credit_simulator,
      'FC_curp' => $FC_curp,
      'FC_birth_certificate' => $FC_birth_certificate,
      'FC_bank_statement' => $FC_bank_statement,
      'FC_single_key_housing_payment' => $FC_single_key_housing_payment,
      'FC_general_buyers_and_sellers' => $FC_general_buyers_and_sellers,
      'FC_education_course' => $FC_education_course,
      'FC_last_pay_stub' => $FC_last_pay_stub,
      'FC_complete' => $FC_complete
    ];
  }

  private function _setCofinavitContractVariables (Request $request)
  {
    $CC_request_for_credit_inspection = !empty($request->CC_request_for_credit_inspection)
                                          ? $this->_date
                                          : null;
    $CC_birth_certificate = !empty($request->CC_birth_certificate)
                              ? $this->_date
                              : null;
    $CC_official_id = !empty($request->CC_official_id)
                        ? $this->_date
                        : null;
    $CC_curp = !empty($request->CC_curp)
                  ? $this->_date
                  : null;
    $CC_rfc = !empty($request->CC_rfc)
                ? $this->_date
                : null;
    $CC_bank_statement_seller = !empty($request->CC_bank_statement_seller)
                                  ? $this->_date
                                  : null;
    $CC_tax_valuation = !empty($request->CC_tax_valuation)
                          ? $this->_date
                          : null;
    $CC_scripture_copy = !empty($request->CC_scripture_copy)
                            ? $this->_date
                            : null;
    $CC_type = !empty($request->CC_type)
                  ? $request->CC_type
                  : null;
    $CC_birth_certificate_of_the_spouse = !empty($request->CC_birth_certificate_of_the_spouse)
                                              ? $this->_date
                                              : null;
    $CC_official_identification_of_the_spouse = !empty($request->CC_official_identification_of_the_spouse)
                                                  ? $this->_date
                                                  : null;
    $CC_marriage_certificate = !empty($request->CC_marriage_certificate)
                                  ? $this->_date
                                  : null;
    $CC_complete = (
      $CC_request_for_credit_inspection &&
      $CC_birth_certificate &&
      $CC_official_id &&
      $CC_curp &&
      $CC_rfc &&
      $CC_bank_statement_seller &&
      $CC_tax_valuation &&
      $CC_scripture_copy &&
      $CC_type
    )
      ? true
      : false;

    return [
      'CC_request_for_credit_inspection' => $CC_request_for_credit_inspection,
      'CC_birth_certificate' => $CC_birth_certificate,
      'CC_official_id' => $CC_official_id,
      'CC_curp' => $CC_curp,
      'CC_rfc' => $CC_rfc,
      'CC_bank_statement_seller' => $CC_bank_statement_seller,
      'CC_tax_valuation' => $CC_tax_valuation,
      'CC_scripture_copy' => $CC_scripture_copy,
      'CC_type' => $CC_type,
      'CC_birth_certificate_of_the_spouse' => $CC_birth_certificate_of_the_spouse,
      'CC_official_identification_of_the_spouse' => $CC_official_identification_of_the_spouse,
      'CC_marriage_certificate' => $CC_marriage_certificate,
      'CC_complete' => $CC_complete
    ];
  }

  private function _setNotaryVariables (Request $request)
  {
    $SN_federal_entity = !empty($request->SN_federal_entity)
                            ? $request->SN_federal_entity
                            : null;
    $SN_notaries_office = !empty($request->SN_notaries_office)
                              ? $request->SN_notaries_office
                              : null;
    $SN_freedom_of_lien_certificate = !empty($request->SN_freedom_of_lien_certificate)
                                          ? $this->_date
                                          : null;
    $SN_zoning = !empty($request->SN_zoning)
                    ? $this->_date
                    : null;
    $SN_water_no_due_constants = !empty($request->SN_water_no_due_constants)
                                    ? $this->_date
                                    : null;
    $SN_non_debit_proof_of_property = !empty($request->SN_non_debit_proof_of_property)
                                          ? $this->_date
                                          : null;
    $SN_certificate_of_improvement = !empty($request->SN_certificate_of_improvement)
                                        ? $this->_date
                                        : null;
    $SN_key_and_cadastral_value = !empty($request->SN_key_and_cadastral_value)
                                      ? $this->_date
                                      : null;
    $SN_complete = ($SN_federal_entity && $SN_notaries_office && $SN_freedom_of_lien_certificate && $SN_zoning && $SN_water_no_due_constants && $SN_non_debit_proof_of_property && $SN_certificate_of_improvement && $SN_key_and_cadastral_value)
                    ? true
                    : false;

    return [
      'SN_federal_entity' => $SN_federal_entity,
      'SN_notaries_office' => $SN_notaries_office,
      'SN_freedom_of_lien_certificate' => $SN_freedom_of_lien_certificate,
      'SN_zoning' => $SN_zoning,
      'SN_water_no_due_constants' => $SN_water_no_due_constants,
      'SN_non_debit_proof_of_property' => $SN_non_debit_proof_of_property,
      'SN_certificate_of_improvement' => $SN_certificate_of_improvement,
      'SN_key_and_cadastral_value' => $SN_key_and_cadastral_value,
      'SN_complete' => $SN_complete
    ];
  }

  private function _setSignatureVariables (Request $request)
  {
    $SS_writing_review = !empty($request->SS_writing_review)
                            ? $this->_date
                            : null;
    $SS_scheduled_date_of_writing_signature = !empty($request->SS_scheduled_date_of_writing_signature)
                                                  ? $this->_date
                                                  : null;
    $SS_writing_signature = !empty($request->SS_writing_signature)
                                ? $this->_date
                                : null;
    $SS_scheduled_payment_date = !empty($request->SS_scheduled_payment_date)
                                    ? $this->_date
                                    : null;
    $SS_payment_made = !empty($request->SS_payment_made)
                          ? $this->_date
                          : null;
    $SS_complete = ($SS_writing_review && $SS_scheduled_date_of_writing_signature && $SS_writing_signature && $SS_scheduled_payment_date && $SS_payment_made)
                    ? true
                    : false;
    return [
      'SS_writing_review' => $SS_writing_review,
      'SS_scheduled_date_of_writing_signature' => $SS_scheduled_date_of_writing_signature,
      'SS_writing_signature' => $SS_writing_signature,
      'SS_scheduled_payment_date' => $SS_scheduled_payment_date,
      'SS_payment_made' => $SS_payment_made,
      'SS_complete' => $SS_complete
    ];
  }
}
