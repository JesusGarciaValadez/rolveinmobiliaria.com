<?php

namespace App\Http\Controllers;

use App\SaleClosingContract;
use App\Sale;
use App\Client;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Carbon\Carbon as Carbon;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Auth as Auth;
use App\Http\Requests\SaleClosingContractRequest;
use App\Events\FileWillUploadEvent;

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
  public function update($sellerId, $closingContractId, SaleClosingContractRequest $request, Sale $sale, SaleClosingContract $saleClosingContract)
  {
    $this->_date = Carbon::now('America/Mexico_City')->toDateString();

    $sale = Sale::findOrFail($sellerId);

    if (
      $request->hasFile('SCC_data_sheet') &&
      $request->file('SCC_data_sheet')->isValid()
    )
    {
      if (
        $request->file('SCC_data_sheet')->extension() === 'pdf' ||
        $request->file('SCC_data_sheet')->extension() === 'doc' ||
        $request->file('SCC_data_sheet')->extension() === 'docx'
      )
      {
        $uploadFile = event(new FileWillUploadEvent($request->file('SCC_data_sheet')));
        $this->_file = !empty($uploadFile)
                          ? $uploadFile[0]
                          : null;
      }
      else
      {
        $this->_message = 'El archivo no puede ser subido porque no es un tipo de archivo válido para subir';
        $this->_type = 'danger';

        return redirect()
                ->back()
                ->withMessage($this->_message)
                ->withType($this->_type);
      }
    }
    else
    {
      $this->_file = !optional($sale->closing_contract->SCC_data_sheet)
                        ? null
                        : $sale->closing_contract->SCC_data_sheet;
    }

    $SCC_exclusivity_contract = !empty($request->SCC_exclusivity_contract)
                                  ? $this->_date
                                  : null;
    $SCC_commercial_valuation = !empty($request->SCC_commercial_valuation)
                                  ? $this->_date
                                  : null;
    $SCC_publication = !empty($request->SCC_publication)
                        ? $this->_date
                        : null;
    $SCC_data_sheet = !empty($this->_file)
                        ? $this->_file
                        : null;
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

    $this->_message = $success
                        ? 'Compraventa actualizada'
                        : 'No se pudo actualizar la compraventa.';
    $this->_type = $success ? 'success' : 'danger';

    if ($request->ajax())
    {
      return response()->json(['message' => $this->_message]);
    }
    else
    {
      if ($this->_type === 'success')
      {
        // event(new SaleCreatedEvent($sale));

        return redirect(route('for_sale.index'))
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
   * @param  \App\SaleClosingContract  $saleClosingContract
   * @return \Illuminate\Http\Response
   */
  public function destroy(Sale $sale, SaleClosingContract $saleClosingContract)
  {
      //
  }
}
