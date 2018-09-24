<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Sale;
use App\InfonavitContract;
use App\FovisssteContract;
use App\CofinavitContract;
use App\Client;

use Illuminate\Http\Request;

use Carbon\Carbon as Carbon;
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

  public function __construct ()
  {
    $this->_locale = \App::getLocale();  }

  /**
   * Display a listing of the resource.
   *
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function index (Sale $sale)
  {
      //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function create (Sale $sale)
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
  public function store (Request $request, Sale $sale)
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
  public function show (Sale $sale, Contract $contract)
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
  public function edit (Sale $sale, Contract $contract)
  {
    $clients = Client::all();

    return view('sales.edit_contract', [
      'uri'      => $this->_uri,
      'sale'     => $sale,
      'clients'  => $clients,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\ContractRequest  $request
   * @param  \App\Sale  $sale
   * @param  \App\Contract  $contract
   * @return \Illuminate\Http\Response
   */
  public function update (ContractRequest $request, Sale $sale, Contract $contract)
  {
    $this->_date = Carbon::create()->format('U');

    $contract_data = $this->setContract ($request);
    $infonavit_contract = $this->setInfonavitContract ($request);
    $fovissste_contracts = $this->setFovisssteContract ($request);
    $cofinavit_contract = $this->setCofinavitContract ($request);
    $contract_with_the_broker = !empty ($request->SC_contract_with_the_broker) ? $this->_date : null;
    $mortgage_broker = !empty ($request->SC_mortgage_broker) ? $this->_date : null;

    $infonavit = empty ($sale->contract->SC_infonavit_contracts_id)
                  ? InfonavitContract::create ($infonavit_contract)
                  : $sale->contract->infonavit_contract()->update ($infonavit_contract);
    $fovissste = empty ($sale->contract->SC_fovissste_contracts_id)
                  ? FovisssteContract::create ($fovissste_contracts)
                  : $sale->contract->fovissste_contract()->update ($fovissste_contracts);
    $cofinavit = empty ($sale->contract->SC_cofinavit_contracts_id)
                  ? CofinavitContract::create ($cofinavit_contract)
                  : $sale->contract->cofinavit_contract()->update ($cofinavit_contract);
    $sale->contract->SC_contract_with_the_broker = $contract_with_the_broker;
    $sale->contract->SC_mortgage_broker = $mortgage_broker;

    $sale->contract->SC_infonavit_contracts_id = ($infonavit)
      ? $sale->contract->infonavit_contract->id
      : $infonavit->id;
    $sale->contract->SC_fovissste_contracts_id = ($fovissste)
      ? $sale->contract->fovissste_contract->id
      : $fovissste->id;
    $sale->contract->SC_cofinavit_contracts_id = ($cofinavit)
      ? $sale->contract->cofinavit_contract->id
      : $cofinavit->id;

    $contract_data['SC_complete'] = $this->getIsContractComplete ([
      'contract_data'             => $contract_data,
      'infonavit_contract'        => $infonavit_contract,
      'fovissste_contracts'       => $fovissste_contracts,
      'cofinavit_contract'        => $cofinavit_contract,
      'contract_with_the_broker'  => $contract_with_the_broker,
      'mortgage_broker'           => $mortgage_broker,
    ]);

    $contract_updated = $contract->update ($contract_data);

    $this->_message = ($contract_updated)
      ? 'Contrato actualizado'
      : 'No se pudo actualizar el contrato.';
    $this->_type = ($contract_updated) ? 'success' : 'danger';
    $request->session()->flash('message', $this->_message)
                       ->flash('type', $this->_type);

    if ($contract_updated)
    {
      return redirect()->route('sale.index');
    }
    else
    {
      return redirect()->back()->withInput();
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Sale  $sale
   * @param  \App\Contract  $contract
   * @return \Illuminate\Http\Response
   */
  public function destroy (Sale $sale, Contract $contract)
  {
    //
  }

  public function setContract (Request $request)
  {
    $SC_mortgage_broker = !empty($request->SC_mortgage_broker) ? $this->_date : null;
    $SC_contract_with_the_broker = !empty($request->SC_contract_with_the_broker) ? $this->_date : null;
    $SC_mortgage_credit = !empty($request->SC_mortgage_credit) ? $request->SC_mortgage_credit : null;
    $SC_general_buyer = !empty($request->SC_general_buyer) ? $this->_date : null;
    $SC_purchase_agreements = !empty($request->SC_purchase_agreements) ? $this->_date : null;
    $SC_tax_assessment = !empty($request->SC_tax_assessment) ? $this->_date : null;
    $SC_notary_checklist = !empty($request->SC_notary_checklist) ? $this->_date : null;
    $SC_notary_file = !empty($request->SC_notary_file) ? $this->_date : null;

    return [
      'SC_mortgage_broker'          => $SC_mortgage_broker,
      'SC_contract_with_the_broker' => $SC_contract_with_the_broker,
      'SC_mortgage_credit'          => $SC_mortgage_credit,
      'SC_general_buyer'            => $SC_general_buyer,
      'SC_purchase_agreements'      => $SC_purchase_agreements,
      'SC_tax_assessment'           => $SC_tax_assessment,
      'SC_notary_checklist'         => $SC_notary_checklist,
      'SC_notary_file'              => $SC_notary_file,
    ];
  }

  public function setInfonavitContract (Request $request)
  {
    $IC_type = !empty($request->IC_type) ? $request->IC_type : null;
    $IC_certified_birth_certificate = !empty($request->IC_certified_birth_certificate) ? $this->_date : null;
    $IC_official_ID = !empty($request->IC_official_ID) ? $this->_date : null;
    $IC_curp = !empty($request->IC_curp) ? $this->_date : null;
    $IC_rfc = !empty($request->IC_rfc) ? $this->_date : null;
    $IC_spouses_birth_certificate = !empty($request->IC_spouses_birth_certificate) ? $this->_date : null;
    $IC_official_identification_of_the_spouse = !empty($request->IC_official_identification_of_the_spouse) ? $this->_date : null;
    $IC_marriage_certificate = !empty($request->IC_marriage_certificate) ? $this->_date : null;
    $IC_credit_simulator = !empty($request->IC_credit_simulator) ? $this->_date : null;
    $IC_credit_application = !empty($request->IC_credit_application) ? $this->_date : null;
    $IC_tax_valuation = !empty($request->IC_tax_valuation) ? $this->_date : null;
    $IC_bank_statement = !empty($request->IC_bank_statement) ? $this->_date : null;
    $IC_workshop_knowing_how_to_decide = !empty($request->IC_workshop_knowing_how_to_decide) ? $this->_date : null;
    $IC_retention_sheet = !empty($request->IC_retention_sheet) ? $this->_date : null;
    $IC_credit_activation = !empty($request->IC_credit_activation) ? $this->_date : null;
    $IC_credit_maturity = !empty($request->IC_credit_maturity) ? $this->_date : null;
    $IC_complete = (
      $IC_type !== null ||
      $IC_certified_birth_certificate !== null ||
      $IC_official_ID !== null ||
      $IC_curp !== null ||
      $IC_rfc !== null ||
      $IC_spouses_birth_certificate !== null ||
      $IC_official_identification_of_the_spouse !== null ||
      $IC_marriage_certificate !== null ||
      $IC_credit_simulator !== null ||
      $IC_credit_application !== null ||
      $IC_tax_valuation !== null ||
      $IC_bank_statement !== null ||
      $IC_workshop_knowing_how_to_decide !== null ||
      $IC_retention_sheet !== null ||
      $IC_credit_activation !== null ||
      $IC_credit_maturity !== null
    );

    return [
      'IC_type'                                   => $IC_type,
      'IC_certified_birth_certificate'            => $IC_certified_birth_certificate,
      'IC_official_ID'                            => $IC_official_ID,
      'IC_curp'                                   => $IC_curp,
      'IC_rfc'                                    => $IC_rfc,
      'IC_spouses_birth_certificate'              => $IC_spouses_birth_certificate,
      'IC_official_identification_of_the_spouse'  => $IC_official_identification_of_the_spouse,
      'IC_marriage_certificate'                   => $IC_marriage_certificate,
      'IC_credit_simulator'                       => $IC_credit_simulator,
      'IC_credit_application'                     => $IC_credit_application,
      'IC_tax_valuation'                          => $IC_tax_valuation,
      'IC_bank_statement'                         => $IC_bank_statement,
      'IC_workshop_knowing_how_to_decide'         => $IC_workshop_knowing_how_to_decide,
      'IC_retention_sheet'                        => $IC_retention_sheet,
      'IC_credit_activation'                      => $IC_credit_activation,
      'IC_credit_maturity'                        => $IC_credit_maturity,
      'IC_complete'                               => $IC_complete,
    ];
  }

  public function setFovisssteContract (Request $request)
  {
    $FC_credit_simulator = !empty($request->FC_credit_simulator) ? $this->_date : null;
    $FC_curp = !empty($request->FC_curp) ? $this->_date : null;
    $FC_birth_certificate = !empty($request->FC_birth_certificate) ? $this->_date : null;
    $FC_bank_statement = !empty($request->FC_bank_statement) ? $this->_date : null;
    $FC_single_key_housing_payment = !empty($request->FC_single_key_housing_payment) ? $this->_date : null;
    $FC_general_buyers_and_sellers = !empty($request->FC_general_buyers_and_sellers) ? $this->_date : null;
    $FC_education_course = !empty($request->FC_education_course) ? $this->_date : null;
    $FC_last_pay_stub = !empty($request->FC_last_pay_stub) ? $this->_date : null;
    $FC_complete = (
      $FC_credit_simulator !== null ||
      $FC_curp !== null ||
      $FC_birth_certificate !== null ||
      $FC_bank_statement !== null ||
      $FC_single_key_housing_payment !== null ||
      $FC_general_buyers_and_sellers !== null ||
      $FC_education_course !== null ||
      $FC_last_pay_stub !== null
    );

    return [
      'FC_credit_simulator'           => $FC_credit_simulator,
      'FC_curp'                       => $FC_curp,
      'FC_birth_certificate'          => $FC_birth_certificate,
      'FC_bank_statement'             => $FC_bank_statement,
      'FC_single_key_housing_payment' => $FC_single_key_housing_payment,
      'FC_general_buyers_and_sellers' => $FC_general_buyers_and_sellers,
      'FC_education_course'           => $FC_education_course,
      'FC_last_pay_stub'              => $FC_last_pay_stub,
      'FC_complete'                   => $FC_complete,
    ];
  }

  public function setCofinavitContract (Request $request)
  {
    $CC_type = !empty($request->CC_type) ? $request->CC_type : null;
    $CC_request_for_credit_inspection = !empty($request->CC_request_for_credit_inspection) ? $this->_date : null;
    $CC_birth_certificate = !empty($request->CC_birth_certificate) ? $this->_date : null;
    $CC_official_id = !empty($request->CC_official_id) ? $this->_date : null;
    $CC_curp = !empty($request->CC_curp) ? $this->_date : null;
    $CC_rfc = !empty($request->CC_rfc) ? $this->_date : null;
    $CC_bank_statement_seller = !empty($request->CC_bank_statement_seller) ? $this->_date : null;
    $CC_tax_valuation = !empty($request->CC_tax_valuation) ? $this->_date : null;
    $CC_scripture_copy = !empty($request->CC_scripture_copy) ? $this->_date : null;
    $CC_birth_certificate_of_the_spouse = !empty($request->CC_birth_certificate_of_the_spouse) ? $this->_date : null;
    $CC_official_identification_of_the_spouse = !empty($request->CC_official_identification_of_the_spouse) ? $this->_date : null;
    $CC_marriage_certificate = !empty($request->CC_marriage_certificate) ? $this->_date : null;
    $CC_complete = (
      $CC_type !== null ||
      $CC_request_for_credit_inspection !== null ||
      $CC_birth_certificate !== null ||
      $CC_official_id !== null ||
      $CC_curp !== null ||
      $CC_rfc !== null ||
      $CC_bank_statement_seller !== null ||
      $CC_tax_valuation !== null ||
      $CC_scripture_copy !== null ||
      $CC_birth_certificate_of_the_spouse !== null ||
      $CC_official_identification_of_the_spouse !== null ||
      $CC_marriage_certificate !== null
    );

    return [
      'CC_type'                                   => $CC_type,
      'CC_request_for_credit_inspection'          => $CC_request_for_credit_inspection,
      'CC_birth_certificate'                      => $CC_birth_certificate,
      'CC_official_id'                            => $CC_official_id,
      'CC_curp'                                   => $CC_curp,
      'CC_rfc'                                    => $CC_rfc,
      'CC_bank_statement_seller'                  => $CC_bank_statement_seller,
      'CC_tax_valuation'                          => $CC_tax_valuation,
      'CC_scripture_copy'                         => $CC_scripture_copy,
      'CC_birth_certificate_of_the_spouse'        => $CC_birth_certificate_of_the_spouse,
      'CC_official_identification_of_the_spouse'  => $CC_official_identification_of_the_spouse,
      'CC_marriage_certificate'                   => $CC_marriage_certificate,
      'CC_complete'                               => $CC_complete,
    ];
  }

  public function getIsContractComplete (Array $contract)
  {
    return (
      $contract['contract_data']['SC_mortgage_broker'] !== null &&
      $contract['contract_data']['SC_contract_with_the_broker'] !== null &&
      $contract['contract_data']['SC_mortgage_credit'] !== null &&
      $contract['contract_data']['SC_general_buyer'] !== null &&
      $contract['contract_data']['SC_purchase_agreements'] !== null &&
      $contract['contract_data']['SC_tax_assessment'] !== null &&
      $contract['contract_data']['SC_notary_checklist'] !== null &&
      $contract['contract_data']['SC_notary_file'] !== null &&
      (
        $contract['infonavit_contract']['IC_complete'] !== null ||
        $contract['fovissste_contracts']['FC_complete'] !== null ||
        $contract['cofinavit_contract']['CC_complete'] !== null ||
        $contract['contract_with_the_broker'] !== null ||
        $contract['mortgage_broker'] !== null
      )
    );
  }
}
