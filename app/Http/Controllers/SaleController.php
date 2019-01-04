<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Client;
use App\ClosingContract;
use App\Contract;
use App\Events\SaleCreatedEvent;
use App\Http\Requests\SellerRequest;
use App\InternalExpedient;
use App\Notary;
use App\Sale;
use App\Seller;
use App\Signature;
use App\State;
use App\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
// Events
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    use ThrottlesLogins;

    private $_uri = 'sale';
    private $_locale;

    private $_expedients;
    private $_clients;
    //Date
    private $_date;

    public function __construct()
    {
        $this->_locale = \App::getLocale();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::orderBy('id', 'desc')->get();

        return view('sales.index', [
            'sales' => $sales,
            'uri' => $this->_uri,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentUser = User::with('role')->find(Auth::id());

        if (
            $currentUser->hasRole(\App\Enums\RoleType::SUPER_ADMIN) ||
            $currentUser->hasRole(\App\Enums\RoleType::ADMIN)
        ) {
            $expedients = InternalExpedient::with('client')
                ->get()
                ->sortBy('expedient');
            $clients = Client::all()
                ->sortBy('last_name')
                ->sortBy('first_name');
        } else {
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
            'states' => $states,
            'expedients' => $expedients,
            'clients' => $clients,
            'uri' => $this->_uri,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SellerRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SellerRequest $request)
    {
        $this->_date = now()->format('U');

        $user_id = User::with('role')->find(Auth::id())->id;
        $internal_expedient_id = $request->internal_expedient_id;
        $seller = $this->_setSellerVariables($request);

        // Creation of seller information
        $sellerCreated = Seller::create($seller);
        $sellerCreated->save();
        $sellers_id = $sellerCreated->id;

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
            'SC_mortgage_credit' => null,
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
            'SN_federal_entity' => \App\Enums\FederalEntityType::CDMX,
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
            'internal_expedients_id' => $internal_expedient_id,
            'sellers_id' => $sellers_id,
            'closing_contracts_id' => $closingContractId,
            'contracts_id' => $contractId,
            'notaries_id' => $notaryId,
            'signatures_id' => $signatureId,
            'user_id' => $user_id,
        ]);
        $saleSaved = $sale->save();

        $this->_message = $saleSaved ? 'Compraventa añadida' : 'No se pudo añadir la compraventa.';
        $this->_type = $saleSaved ? 'success' : 'danger';

        if (empty($this->_message)) {
            $this->_message = ($sellerCreated) ? 'La compraventa fue creada.' : 'No se pudo crear la compraventa.';
        }

        if (empty($this->_type)) {
            $this->_type = ($sellerCreated) ? 'success' : 'danger';
        }

        $request->session()->flash('message', $this->_message);
        $request->session()->flash('type', $this->_type);

        if ($saleSaved) {
            event(new SaleCreatedEvent($sale));

            return redirect()->route('sale.index');
        }

        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        return view('sales.show', [
            'sale' => $sale,
            'uri' => $this->_uri,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $currentUser = User::with('role')->find(Auth::id());

        if (
            $currentUser->hasRole(\App\Enums\RoleType::SUPER_ADMIN) ||
            $currentUser->hasRole(\App\Enums\RoleType::ADMIN)
        ) {
            $expedients = InternalExpedient::with('client')->get()->sortBy('expedient');
            $clients = Client::all()->sortBy('last_name')->sortBy('first_name');
        } else {
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

        return view('sales.edit', [
            'states' => $states,
            'expedients' => $expedients,
            'sale' => $sale,
            'clients' => $clients,
            'uri' => $this->_uri,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SaleRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SaleRequest $request, Sale $sale)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale, Request $request)
    {
        $destroyed = $sale->delete();

        $this->_message = ($destroyed) ? 'Llamada eliminada' : 'No se pudo eliminar la llamada.';
        $this->_type = ($destroyed) ? 'success' : 'danger';
        $request->session()->flash('message', $this->_message);
        $request->session()->flash('type', $this->_type);

        return redirect()->route('sale.index');
    }

    private function _setSellerVariables(Request $request)
    {
        $SD_deed = !empty($request->SD_deed) ? $this->_date : null;
        $SD_water = !empty($request->SD_water) ? $this->_date : null;
        $SD_predial = !empty($request->SD_predial) ? $this->_date : null;
        $SD_light = !empty($request->SD_light) ? $this->_date : null;
        $SD_birth_certificate = !empty($request->SD_birth_certificate) ? $this->_date : null;
        $SD_ID = !empty($request->SD_ID) ? $this->_date : null;
        $SD_CURP = !empty($request->SD_CURP) ? $request->SD_CURP : null;
        $SD_RFC = !empty($request->SD_RFC) ? $request->SD_RFC : null;
        $SD_account_status = !empty($request->SD_account_status) ? $this->_date : null;
        $SD_email = !empty($request->SD_email) ? $this->_date : null;
        $SD_phone = !empty($request->SD_phone) ? $this->_date : null;
        $SD_civil_status = !empty($request->SD_civil_status) ? $request->SD_civil_status : 'Soltero';
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
        ) ? true : false;

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
            'SD_complete' => $SD_complete,
        ];
    }
}
