<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Client;
use App\ClosingContract;
use App\Events\FileWillUploadEvent;
use App\Http\Requests\ClosingContractRequest;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class ClosingContractController extends Controller
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
     * File uploaded.
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

    public function __construct()
    {
        $this->_locale = \App::getLocale();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Sale $sale)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Sale $sale)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Sale $sale)
    {
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale, ClosingContract $closingContract)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale, ClosingContract $closingContract)
    {
        $clients = Client::all();

        return view('sales.edit_closing_contract', [
            'uri' => $this->_uri,
            'sale' => $sale,
            'clients' => $clients,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ClosingContractRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ClosingContractRequest $request, Sale $sale, ClosingContract $closingContract)
    {
        $this->_date = now()->format('U');

        if (
            $request->hasFile('SCC_data_sheet') &&
            $request->file('SCC_data_sheet')->isValid()
        ) {
            if (
              $request->file('SCC_data_sheet')->extension() === 'pdf' ||
              $request->file('SCC_data_sheet')->extension() === 'doc' ||
              $request->file('SCC_data_sheet')->extension() === 'docx'
            ) {
                $uploadFile = event(new FileWillUploadEvent($request->file('SCC_data_sheet')));
                $this->_file = !empty($uploadFile) ? $uploadFile[0] : null;
            } else {
                $this->_message = 'El archivo no puede ser subido porque no es un tipo de archivo válido para subir';
                $this->_type = 'danger';
                $this->_payload = ['message' => $this->_message, 'type' => $this->_type];

                return redirect()->back()->withInput($this->_payload);
            }
        } else {
            $this->_file = optional($sale->closing_contract)->SCC_data_sheet;
        }

        $SCC_exclusivity_contract = !empty($request->SCC_exclusivity_contract)
            ? Carbon::parse($request->SCC_exclusivity_contract)->format('U')
            : null;
        $SCC_commercial_valuation = !empty($request->SCC_commercial_valuation)
            ? Carbon::parse($request->SCC_commercial_valuation)->format('U')
            : null;
        $SCC_publication = !empty($request->SCC_publication)
            ? Carbon::parse($request->SCC_publication)->format('U')
            : null;
        $SCC_data_sheet = !empty($this->_file) ? $this->_file : null;
        $SCC_closing_contract_observations = !empty($request->SCC_closing_contract_observations)
            ? $request->SCC_closing_contract_observations
            : null;
        $SCC_complete = (
            $SCC_exclusivity_contract === null ||
            $SCC_commercial_valuation === null ||
            $SCC_publication === null ||
            $SCC_data_sheet === null ||
            $SCC_closing_contract_observations === null
        ) ? false
          : true;

        $closingContract = [
            'SCC_exclusivity_contract' => $SCC_exclusivity_contract,
            'SCC_commercial_valuation' => $SCC_commercial_valuation,
            'SCC_publication' => $SCC_publication,
            'SCC_data_sheet' => $SCC_data_sheet,
            'SCC_closing_contract_observations' => $SCC_closing_contract_observations,
            'SCC_complete' => $SCC_complete,
        ];

        $success = $sale->closing_contract()->update($closingContract);

        $this->_message = $success ? 'Contrato de cierre actualizado' : 'No se pudo actualizar el contrato de cierre.';
        $this->_type = $success ? 'success' : 'danger';
        $request->session()->flash('message', $this->_message);
        $request->session()->flash('type', $this->_type);

        // event(new SaleCreatedEvent($sale));

        if ($success) {
            return redirect()->route('sale.index');
        }

        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale, ClosingContract $closingContract)
    {
    }
}
