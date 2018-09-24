<?php

namespace App\Http\Controllers;

use App\InternalExpedient;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;

use App\Http\Requests\InternalExpedientRequest;
use Carbon\Carbon;

class InternalExpedientController extends Controller
{
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

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $client = InternalExpedient::with([
                'user',
                'client'
              ])
              ->get();

    if ($request->ajax())
    {
      return response()->json([$client]);
    }
    else
    {
      return abort(404);
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(InternalExpedientRequest $request)
  {
    Carbon::setLocale('mx');
    Carbon::setUtf8(true);
    $year = Carbon::createFromDate($request->expedient_year);

    $data = [
      'client_id'         => $request->client_id,
      'user_id'           => \Auth::id(),
      'expedient_key'     => $request->expedient_key,
      'expedient_number'  => $request->expedient_number,
      'expedient_year'    => $year->formatLocalized('%y'),
    ];

    $updated = InternalExpedient::create($data);

    $this->_message = ($updated)
      ? 'Nuevo expediente interno creado'
      : 'No se pudo crear el expediente interno.';
    $this->_type = ($updated) ? 'success' : 'danger';
    $request->session()->flash('message', $this->_message);
    $request->session()->flash('type', $this->_type);

    if ($request->ajax())
    {
      return response()->json(['message' => $this->_message]);
    }
    else
    {
      return redirect()->back()->withInput();
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\InternalExpedient  $internalExpedient
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request)
  {
    $expedient = InternalExpedient::findOrFail($request->id);

    if ($request->ajax())
    {
      return response()->json([$expedient]);
    }
    else
    {
      return abort(404);
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\InternalExpedient  $internalExpedient
   * @return \Illuminate\Http\Response
   */
  public function edit(InternalExpedient $internalExpedient)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\InternalExpedient  $internalExpedient
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, InternalExpedient $internalExpedient)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\InternalExpedient  $internalExpedient
   * @return \Illuminate\Http\Response
   */
  public function destroy(InternalExpedient $internalExpedient)
  {
    $expedient = InternalExpedient::with([
                    'user',
                    'client'
                  ])
                  ->findOrFail($request->id);
    $isDestroyed = $expedient->delete();

    $this->_message = ($isDestroyed)
      ? 'Llamada eliminada'
      : 'No se pudo eliminar la llamada.';

    $this->_type = ($isDestroyed) ? 'success' : 'danger';

    return redirect()->route('internal_expedient.index', $this->_payload);
  }
}
