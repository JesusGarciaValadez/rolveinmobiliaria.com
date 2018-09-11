<?php

namespace App\Http\Controllers;

use App\Signature;
use App\Sale;
use App\Client;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Carbon\Carbon as Carbon;

class SignatureController extends Controller
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
   * @param  \App\Signature  $signature
   * @return \Illuminate\Http\Response
   */
  public function show(Sale $sale, Signature $signature)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Sale  $sale
   * @param  \App\Signature  $signature
   * @return \Illuminate\Http\Response
   */
  public function edit(Sale $sale, Signature $signature)
  {
    $clients = Client::all();

    return view('sales.edit_signature')
            ->withUri($this->_uri)
            ->withSale($sale)
            ->withClients($clients);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Sale  $sale
   * @param  \App\Signature  $signature
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Sale $sale, Signature $signature)
  {
    $this->_date = Carbon::now('America/Mexico_City')->toDateString();
    $SS_writing_review = !empty($request->SS_writing_review) ? $this->_date : null;
    $SS_scheduled_date_of_writing_signature = !empty($request->SS_scheduled_date_of_writing_signature) ? $this->_date : null;
    $SS_writing_signature = !empty($request->SS_writing_signature) ? $this->_date : null;
    $SS_scheduled_payment_date = !empty($request->SS_scheduled_payment_date) ? $this->_date : null;
    $SS_payment_made = !empty($request->SS_payment_made) ? $this->_date : null;
    $SS_complete = (
      $SS_writing_review !== null ||
      $SS_scheduled_date_of_writing_signature !== null ||
      $SS_writing_signature !== null ||
      $SS_scheduled_payment_date !== null ||
      $SS_payment_made !== null
    );
    $signatureInfo = [
      'SS_writing_review' => $SS_writing_review,
      'SS_scheduled_date_of_writing_signature' => $SS_scheduled_date_of_writing_signature,
      'SS_writing_signature' => $SS_writing_signature,
      'SS_scheduled_payment_date' => $SS_scheduled_payment_date,
      'SS_payment_made' => $SS_payment_made,
      'SS_complete' => $SS_complete,
    ];
    $signature = $sale->signature()
                   ->update($signatureInfo);

    $this->_message = $signature
                        ? 'Firma actualizada'
                        : 'No se pudo actualizar la firma.';
    $this->_type = $signature ? 'success' : 'danger';

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
   * @param  \App\Signature  $signature
   * @return \Illuminate\Http\Response
   */
  public function destroy(Sale $sale, Signature $signature)
  {
    //
  }
}
