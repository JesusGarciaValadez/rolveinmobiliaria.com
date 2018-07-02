<?php

namespace App\Http\Controllers;

use App\Sale as Sale;
use App\Client as Client;
use App\State as State;
use App\InternalExpedient as InternalExpedient;
use App\User as User;
use App\SaleSeller as Seller;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Carbon\Carbon as Carbon;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Gate as Gate;
use Illuminate\Support\Facades\Auth as Auth;
use App\Http\Requests\SaleSellerRequest as SaleSellerRequest;

class SaleSellerController extends Controller
{
  use ThrottlesLogins;

  /**
   * Set the uri returned to views.
   *
   * @var string
   */
  private $_uri = 'sale_seller';

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
   * Show the form for editing the specified resource.
   *
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function edit (Request $request)
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

    $sale = Sale::findOrFail($request->id);

    $internal_expedient = InternalExpedient::findOrFail($sale->internal_expedient->id);

    return view('sales.edit_seller')
            ->withSale($sale)
            ->withStates($states)
            ->withExpedients($expedients)
            ->withInternalExpedient($internal_expedient)
            ->withClients($clients)
            ->withUri($this->_uri);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\SaleSellerRequest  $request
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function update ($id, $sellerId, SaleSellerRequest $request)
  {
    $this->_date = Carbon::now('America/Mexico_City')->toDateString();
    $internal_expedient_id = !empty($request->internal_expedient_id)
                              ? ['internal_expedients_id' => $request->internal_expedient_id]
                              : null;
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
                        : null;
    $SD_complete = (
      $internal_expedient_id === null ||
      $SD_deed === null ||
      $SD_water === null ||
      $SD_predial === null ||
      $SD_light === null ||
      $SD_birth_certificate === null ||
      $SD_ID === null ||
      $SD_CURP === null ||
      $SD_RFC === null ||
      $SD_account_status === null ||
      $SD_email === null ||
      $SD_phone === null ||
      $SD_civil_status === null
    ) ? false
      : true;

    $sale = Sale::findOrFail($id);
    $sale->update($internal_expedient_id);

    $seller = [
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

    $saleSeller = Seller::findOrFail($sellerId);
    $saleSeller->update($seller);
    \Debugbar::info($seller);
    \Debugbar::info($saleSeller);

    $this->_message = $saleSeller && $sale
                        ? 'Compraventa actualizada'
                        : 'No se pudo actualizar la compraventa.';
    $this->_type = $saleSeller && $sale ? 'success' : 'danger';

    if ($request->ajax())
    {
      return response()->json(['message' => $this->_message]);
    }
    else
    {
      if ($this->_type === 'success')
      {
        // event(new SaleCreatedEvent($sale));

        return redirect('for_sales')
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
}
