<?php

namespace App\Http\Controllers;

use App\Sale as Sale;
use App\State as State;
use App\Client as Client;
use App\User as User;
use App\SaleDocument as Document;
use App\SaleClosingContract as ClosingContract;
use App\SaleContract as Contract;
use App\SaleNotary as Notary;
use App\SaleSignature as Signature;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\SaleRequest;
use App\Events\FileWillUpload;

class SaleController extends Controller
{
  use ThrottlesLogins;

  private $_uri = '';
  private $_locale = '';
  private $_expedients;
  private $_clients;
  // Documents
  private $_documents;
  // Closing contract
  private $_closing_contract;
  // Contract
  private $_contract;
  // Infonavit contract
  private $_infonavit_contract;
  // Fovisste contract
  private $_fovissste_contract;
  // Cofinavit contract
  private $_cofinavit_contract;
  // Notary
  private $_notary;
  // Signature
  private $_signature;
  //Date
  private $_date;
  // File uploaded
  private $_file;

  private $_documents_id;
  private $_closing_contracts_id;
  private $_contracts_id;
  private $_notaries_id;
  private $_signatures_id;

  private $_documentIsEmpty;
  private $_closingContractIsComplete;
  private $_infonavitContractIsComplete;
  private $_fovisssteContractIsComplete;
  private $_cofinavitContractIsComplete;
  private $_contractIsComplete;
  private $_notaryIsComplete;
  private $_signatureIsComplete;

  private $_documentCreated;
  private $_documentUpdated;
  private $_closingContractCreated;
  private $_closingContractUpdated;
  private $_infonavitContractCreated;
  private $_infonavitContractUpdated;
  private $_fovisssteContractCreated;
  private $_fovisssteContractUpdated;
  private $_cofinavitContractCreated;
  private $_cofinavitContractUpdated;
  private $_contractCreated;
  private $_contractUpdated;
  private $_notaryCreated;
  private $_notaryUpdated;
  private $_signatureCreated;
  private $_signatureUpdated;

  private $_message;
  private $_type;

  public function __constructor ()
  {
    $this->_locale = \App::getLocale();

    $this->_uri = 'for_sales';
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index ()
  {
    $sales = Sale::orderBy('id', 'desc')->paginate(5);

    return view('sales.index', compact('sales', 'uri'));
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
    ) {
      $expedients = InternalExpedient::with('client')
                      ->get()
                      ->sortBy('expedient');
    } else {
      $expedients = InternalExpedient::with('client')
                      ->where('user_id', Auth::id())
                      ->get()
                      ->sortBy('expedient');
    }

    $states = State::all();

    return view('sales.create')
            ->withUri($this->_uri)
            ->withStates($states)
            ->withExpedients($expedients);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store (SaleRequest $request)
  {
    $this->_date = Carbon::now('America/Mexico_City')->toDateString();

    $this->_setInitialVariables($request);

    $this->_determineWhichSectionIsEmpty();

    if (empty($documentID) && $this->_documentIsComplete) {
      $this->_documentCreated = Document::create($this->_document);
      $this->_documents_id = $this->_documentCreated->id ? $this->_documentCreated->id : null;
    }

    if (empty($closingContractID) && $this->_closingContractIsComplete) {
      $this->_closingContractCreated = ClosingContract::create($this->_closing_contract);
      $this->_closing_contracts_id = $this->_closingContractCreated->id ? $this->_closingContractCreated->id : null;
    }

    if (empty($contractID) && $this->_contractIsComplete) {
      $this->_contractCreated = Contract::create($this->_contract);
      $this->_contracts_id = $this->_contractCreated->id ? $this->_contractCreated->id : null;
    }

    if (empty($notaryID) && $this->_notaryIsComplete) {
      $this->_notaryCreated = Notary::create($this->_notary);
      $this->_notaries_id = $this->_notaryCreated->id ? $this->_notaryCreated->id : null;
    }

    if (empty($signatureID) && $this->_signatureIsComplete) {
      $this->_signatureCreated = Signature::create($this->_signature);
      $this->_signatures_id = $this->_signatureCreated->id ? $this->_signatureCreated->id : null;
    }

    $sale = new Sale([
      'sale_documents_id' => $this->_documents_id,
      'sale_closing_contracts_id' => $this->closing_contracts_id,
      'sale_contracts_id' => $this->contracts_id,
      'sale_notaries_id' => $this->_notaries_id,
      'sale_signatures_id' => $this->_signatures_id
    ]);

    $sale->save();

    if (empty($this->_message))
    {
      $this->_message = (
        $this->_documentCreated ||
        $this->_closingContractCreated ||
        $this->_contractCreated ||
        $this->_notaryCreated ||
        $this->_signatureCreated
      )
        ? 'La compraventa fue creada.'
        : 'No se pudo crear la compraventa.';
    }

    if (empty($this->_type)) {
      $this->_type = (
        $this->_documentCreated ||
        $this->_closingContractCreated ||
        $this->_contractCreated ||
        $this->_notaryCreated ||
        $this->_signatureCreated
      )
        ? 'success'
        : 'danger';
    }

    if ($request->ajax())
    {
      return response()->json(['message' => $this->_message]);
    }
    else
    {
      return redirect('for_sales')
              ->with('message', $this->_message)
              ->with('type', $this->_type);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function show (Request $request)
  {
    $sale = Sale::findOrFail($request->id);

    return view('sales.show', compact('uri', 'sale'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function edit (Request $request)
  {
    $states = State::all();

    $sale = Sale::findOrFail($request->id);

    $clients = Client::all()
                ->sortBy('last_name')
                ->sortBy('first_name');

    return view('sales.edit', compact('this->_uri', 'states', 'sale', 'clients'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function update (SaleRequest $request)
  {
    $this->_date = Carbon::now('America/Mexico_City')->toDateString();

    $this->_setInitialVariables($request);

    \Debugbar::info($this->_document);
    \Debugbar::info($this->_closing_contract);
    \Debugbar::info($this->_infonavit_contract);
    \Debugbar::info($this->_fovissste_contract);
    \Debugbar::info($this->_cofinavit_contract);
    \Debugbar::info($this->_contract);
    \Debugbar::info($this->_notary);
    \Debugbar::info($this->_signature);

    $this->_determineWhichSectionIsEmpty();

    \Debugbar::info(!$this->_documentIsComplete);
    \Debugbar::info(!$this->_closingContractIsComplete);
    \Debugbar::info(!$this->_infonavitContractIsComplete);
    \Debugbar::info(!$this->_fovisssteContractIsComplete);
    \Debugbar::info(!$this->_cofinavitContractIsComplete);
    \Debugbar::info(!$this->_contractIsComplete);
    \Debugbar::info(!$this->_notaryIsComplete);
    \Debugbar::info(!$this->_signatureIsComplete);

    $sale = Sale::findOrFail($request->id);
    $documentID = $sale->document->id ? $sale->document->id : null;
    $closingContractID = $sale->closing_contract->id ? $sale->closing_contract->id : null;
    $infonavitContractID = (!empty($sale->contract) && !empty($sale->contract->infonavit_contract))
                            ? $sale->contract->infonavit_contract->id
                            : null;
    $fovisssteContractID = (!empty($sale->contract) && !empty($sale->contract->fovissste_contract))
                            ? $sale->contract->fovissste_contract->id
                            : null;
    $cofinavitContractID = (!empty($sale->contract) && !empty($sale->contract->cofinavit_contract))
                            ? $sale->contract->cofinavit_contract->id
                            : null;
    $contractID = $sale->contract->id ? $sale->contract->id : null;
    $notaryID = $sale->notary->id ? $sale->notary->id : null;
    $signatureID = $sale->signature->id ? $sale->signature->id : null;

    if (empty($documentID) && $this->_documentIsComplete) {
      $this->_documentCreated = Document::create($this->_document);
      $sale->sale_documents_id = $this->_documentCreated->id;
      $sale->save();
    }
    elseif (!$this->_documentIsComplete)
    {
      $this->_documentUpdated = Document::where('id', $documentID)->update($this->_document);
    }

    if (empty($closingContractID) && $this->_closingContractIsComplete) {
      $this->_closingContractCreated = ClosingContract::create($this->_closing_contract);
      $sale->closing_contracts_id = $this->_closingContractCreated->id;
      $sale->save();
    }
    elseif ($this->_closingContractIsComplete)
    {
      $this->_closingContractUpdated = ClosingContract::where('id', $closingContractID)
                                        ->update($this->_closing_contract);
    }

    if (empty($contractID) && $this->_contractIsComplete) {
      $this->_contractCreated = Contract::create($this->_contract);
      $sale->contracts_id = $this->_contractCreated->id;
      $sale->save();
    }
    elseif ($this->_contractIsComplete)
    {
      $this->_contractUpdated = Contract::where('id', $contractID)->update($this->_contract);
    }

    if (empty($contractID) && $this->_notaryIsComplete) {
      $this->_notaryCreated = Notary::create($this->_notary);
      $sale->sale_notaries_id = $this->_notaryCreated->id;
      $sale->save();
    }
    elseif ($this->_notaryIsComplete)
    {
      $this->_notaryUpdated = Notary::where('id', $contractID)->update($this->_notary);
    }

    if (empty($signatureID) && $this->_signatureIsComplete) {
      $this->_signatureCreated = Signature::create($this->_signature);
      $sale->sale_signatures_id = $this->_signatureCreated->id;
      $sale->save();
    }
    elseif ($this->_signatureIsComplete)
    {
      $this->_signatureUpdated = Signature::where('id', $signatureID)->update($this->_signature);
    }

    if (empty($this->_message))
    {
      $this->_message = (
        $this->_documentCreated ||
        $this->_documentUpdated ||
        $this->_closingContractCreated ||
        $this->_closingContractUpdated ||
        $this->_contractCreated ||
        $this->_contractUpdated ||
        $this->_notaryCreated ||
        $this->_notaryUpdated ||
        $this->_signatureCreated ||
        $this->_signatureUpdated
      )
        ? 'La compraventa fue actualizada.'
        : 'No se pudo actualizar la compraventa.';
    }

    if (empty($this->_type)) {
      $this->_type = (
        $this->_documentCreated ||
        $this->_documentUpdated ||
        $this->_closingContractCreated ||
        $this->_closingContractUpdated ||
        $this->_contractCreated ||
        $this->_contractUpdated ||
        $this->_notaryCreated ||
        $this->_notaryUpdated ||
        $this->_signatureCreated ||
        $this->_signatureUpdated
      )
        ? 'success'
        : 'danger';
    }

    if ($request->ajax())
    {
      return response()->json(['message' => $this->_message]);
    }
    else
    {
      return redirect()
              ->back()
              ->with('message', $this->_message)
              ->with('type', $this->_type);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function destroy (Request $request)
  {
    $sale = Sale::findOrFail($request->id);
    $destroyed = $sale->delete();

    $message = ($destroyed) ? 'Llamada eliminada' : 'No se pudo eliminar la llamada.';
    $type = ($destroyed) ? 'success' : 'danger';

    if ( $request->ajax() )
    {
      return response()
              ->json( [ 'message' => $message ] );
    }
    else
    {
      return redirect(route('for_sales'))
              ->with( 'message', $message )
              ->with( 'type', 'success' );
    }
  }

  private function _setInitialVariables(Request $request)
  {
    $currentUser = User::with('role')->find(Auth::id());

    if (
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    ) {
      $this->_expedients = InternalExpedient::with('client')
                      ->get()
                      ->sortBy('expedient');
      $$this->_clients = Client::all()
                  ->sortBy('last_name')
                  ->sortBy('first_name');
    } else {
      $this->_expedients = InternalExpedient::with('client')
                      ->where('user_id', Auth::id())
                      ->get()
                      ->sortBy('expedient');
      $this->_clients = Client::where('user_id', Auth::id())
                  ->get()
                  ->sortBy('last_name')
                  ->sortBy('first_name');
    }

    $this->_user_id = User::with('role')->find(Auth::id());
    $this->_document = $this->_setDocumentVariables($request);
    $this->_closing_contract = $this->_setClosingContractVariables($request);
    $this->_infonavit_contract = $this->_setInfonavitContractVariables($request);
    $this->_fovissste_contract = $this->_setFovisssteContractVariables($request);
    $this->_cofinavit_contract = $this->_setCofinavitContractVariables($request);
    $this->_contract = $this->_setContractVariables($request);
    $this->_notary = $this->_setNotaryVariables($request);
    $this->_signature = $this->_setSignatureVariables($request);
  }

  private function _setDocumentVariables (Request $request)
  {
    $SD_predial = !empty($request->SD_predial)
                    ? $this->_date
                    : null;
    $SD_light = !empty($request->SD_light)
                  ? $this->_date
                  : null;
    $SD_water = !empty($request->SD_water)
                  ? $this->_date
                  : null;
    $SD_deed = !empty($request->SD_deed)
                  ? $this->_date
                  : null;
    $SD_generals_sheet = !empty($request->SD_generals_sheet)
                            ? $this->_date
                            : null;
    $SD_INE = !empty($request->SD_INE)
                ? $this->_date
                : null;
    $SD_CURP = !empty($request->SD_CURP)
                  ? $this->_date
                  : null;
    $SD_birth_certificate = !empty($request->SD_birth_certificate)
                              ? $this->_date
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
                          : null;
    $SD_complete = (
      $SD_predial &&
      $SD_light &&
      $SD_water &&
      $SD_deed &&
      $SD_generals_sheet &&
      $SD_INE &&
      $SD_CURP &&
      $SD_birth_certificate &&
      $SD_account_status &&
      $SD_email &&
      $SD_phone &&
      $SD_civil_status
    )
      ? '1'
      : '0';

    return [
      'SD_predial' => $SD_predial,
      'SD_light' => $SD_light,
      'SD_water' => $SD_water,
      'SD_deed' => $SD_deed,
      'SD_generals_sheet' => $SD_generals_sheet,
      'SD_INE' => $SD_INE,
      'SD_CURP' => $SD_CURP,
      'SD_birth_certificate' => $SD_birth_certificate,
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
      ? '1'
      : '0';

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
      ? '1'
      : '0';

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
      ? '1'
      : '0';

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
      ? '1'
      : '0';

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
      ? '1'
      : '0';

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
                    ? '1'
                    : '0';

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
                    ? '1'
                    : '0';
    return [
      'SS_writing_review' => $SS_writing_review,
      'SS_scheduled_date_of_writing_signature' => $SS_scheduled_date_of_writing_signature,
      'SS_writing_signature' => $SS_writing_signature,
      'SS_scheduled_payment_date' => $SS_scheduled_payment_date,
      'SS_payment_made' => $SS_payment_made,
      'SS_complete' => $SS_complete
    ];
  }

  private function _determineWhichSectionIsEmpty()
  {
    $this->_documentIsComplete = !$this->_documentIsEmpty();
    $this->_closingContractIsComplete = !$this->_closingContractIsEmpty();
    $this->_infonavitContractIsComplete = !$this->_infonavitContractIsEmpty();
    $this->_fovisssteContractIsComplete = !$this->_fovisssteContractIsEmpty();
    $this->_cofinavitContractIsComplete = !$this->_cofinavitContractIsEmpty();
    $this->_contractIsComplete = !$this->_contractIsEmpty();
    $this->_notaryIsComplete = !$this->_notaryIsEmpty();
    $this->_signatureIsComplete = !$this->_signatureIsEmpty();
  }

  private function _documentIsEmpty ()
  {
    return (
      empty($this->_document['SD_predial']) &&
      empty($this->_document['SD_light']) &&
      empty($this->_document['SD_water']) &&
      empty($this->_document['SD_deed']) &&
      empty($this->_document['SD_generals_sheet']) &&
      empty($this->_document['SD_INE']) &&
      empty($this->_document['SD_CURP']) &&
      empty($this->_document['SD_birth_certificate']) &&
      empty($this->_document['SD_account_status']) &&
      empty($this->_document['SD_email']) &&
      empty($this->_document['SD_phone']) &&
      empty($this->_document['SD_civil_status'])
    );
  }

  private function _closingContractIsEmpty ()
  {
    return (
      empty($this->_closing_contract['SCC_commercial_valuation']) &&
      empty($this->_closing_contract['SCC_exclusivity_contract']) &&
      empty($this->_closing_contract['SCC_publication']) &&
      empty($this->_closing_contract['SCC_data_sheet']) &&
      empty($this->_closing_contract['SCC_closing_contract_observations'])
    );
  }

  private function _contractIsEmpty ()
  {
    return (
      empty($this->_contract['SC_general_buyer']) &&
      empty($this->_contract['SC_purchase_agreements']) &&
      empty($this->_contract['SC_tax_assessment']) &&
      empty($this->_contract['SC_notary_checklist']) &&
      empty($this->_contract['SC_notary_file']) &&
      empty($this->_contract['SC_mortgage_credit']) &&
      empty($this->_contract['SC_mortgage_broker']) &&
      empty($this->_contract['SC_contract_with_the_broker'])
    );
  }

  private function _infonavitContractIsEmpty ()
  {
    return (
      empty($this->_infonavit_contract['IC_certified_birth_certificate']) &&
      empty($this->_infonavit_contract['IC_official_ID']) &&
      empty($this->_infonavit_contract['IC_curp']) &&
      empty($this->_infonavit_contract['IC_rfc']) &&
      empty($this->_infonavit_contract['IC_credit_simulator']) &&
      empty($this->_infonavit_contract['IC_credit_application']) &&
      empty($this->_infonavit_contract['IC_tax_valuation']) &&
      empty($this->_infonavit_contract['IC_bank_statement']) &&
      empty($this->_infonavit_contract['IC_workshop_knowing_how_to_decide']) &&
      empty($this->_infonavit_contract['IC_retention_sheet']) &&
      empty($this->_infonavit_contract['IC_credit_activation']) &&
      empty($this->_infonavit_contract['IC_credit_maturity']) &&
      empty($this->_infonavit_contract['IC_type']) &&
      empty($this->_infonavit_contract['IC_spouses_birth_certificate']) &&
      empty($this->_infonavit_contract['IC_official_identification_of_the_spouse']) &&
      empty($this->_infonavit_contract['IC_marriage_certificate'])
    );
  }

  private function _fovisssteContractIsEmpty ()
  {
    return (
      empty($this->_fovissste_contract['FC_credit_simulator']) &&
      empty($this->_fovissste_contract['FC_curp']) &&
      empty($this->_fovissste_contract['FC_birth_certificate']) &&
      empty($this->_fovissste_contract['FC_bank_statement']) &&
      empty($this->_fovissste_contract['FC_single_key_housing_payment']) &&
      empty($this->_fovissste_contract['FC_general_buyers_and_sellers']) &&
      empty($this->_fovissste_contract['FC_education_course']) &&
      empty($this->_fovissste_contract['FC_last_pay_stub'])
    );
  }

  private function _cofinavitContractIsEmpty ()
  {
    return (
      empty($this->_cofinavit_contract['CC_request_for_credit_inspection']) &&
      empty($this->_cofinavit_contract['CC_birth_certificate']) &&
      empty($this->_cofinavit_contract['CC_official_id']) &&
      empty($this->_cofinavit_contract['CC_curp']) &&
      empty($this->_cofinavit_contract['CC_rfc']) &&
      empty($this->_cofinavit_contract['CC_bank_statement_seller']) &&
      empty($this->_cofinavit_contract['CC_tax_valuation']) &&
      empty($this->_cofinavit_contract['CC_scripture_copy']) &&
      empty($this->_cofinavit_contract['CC_type']) &&
      empty($this->_cofinavit_contract['CC_birth_certificate_of_the_spouse']) &&
      empty($this->_cofinavit_contract['CC_official_identification_of_the_spouse']) &&
      empty($this->_cofinavit_contract['CC_marriage_certificate'])
    );
  }

  private function _notaryIsEmpty ()
  {
    return (
      empty($this->_notary['SN_federal_entity']) &&
      empty($this->_notary['SN_notaries_office']) &&
      empty($this->_notary['SN_freedom_of_lien_certificate']) &&
      empty($this->_notary['SN_zoning']) &&
      empty($this->_notary['SN_water_no_due_constants']) &&
      empty($this->_notary['SN_non_debit_proof_of_property']) &&
      empty($this->_notary['SN_certificate_of_improvement']) &&
      empty($this->_notary['SN_key_and_cadastral_value'])
    );
  }

  private function _signatureIsEmpty ()
  {
     return (
      empty($this->_signature['SS_writing_review']) &&
      empty($this->_signature['SS_scheduled_date_of_writing_signature']) &&
      empty($this->_signature['SS_writing_signature']) &&
      empty($this->_signature['SS_scheduled_payment_date']) &&
      empty($this->_signature['SS_payment_made'])
    );
  }
}
