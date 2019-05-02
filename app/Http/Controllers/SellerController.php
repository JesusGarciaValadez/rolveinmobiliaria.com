<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Client;
use App\InternalExpedient;
use App\Sale;
use App\Seller;
use App\State;
use App\User;
use Carbon\Carbon as Carbon;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
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
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Sale     $sale
     * @param  \Illuminate\Http\Seller   $seller
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale, Seller $seller, Request $request)
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

        $internal_expedient = InternalExpedient::findOrFail($sale->internal_expedient->id);

        return view('sales.edit_seller', [
            'sale' => $sale,
            'states' => $states,
            'expedients' => $expedients,
            'internal_expedient' => $internal_expedient,
            'clients' => $clients,
            'uri' => $this->_uri,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SellerRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $this->_date = Carbon::create()->format('U');
        $internal_expedient_id = !empty($request->internal_expedient_id) ? ['internal_expedients_id' => $request->internal_expedient_id] : null;
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
        $SD_civil_status = !empty($request->SD_civil_status) ? $request->SD_civil_status : null;
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
        ) ? false : true;

        if ($internal_expedient_id !== null) {
            $sale->update($internal_expedient_id);
        }

        $sellerInfo = [
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

        $seller = $sale->seller()->update($sellerInfo);

        $this->_message = $seller && $sale ? 'Vendedor actualizado' : 'No se pudo actualizar al vendedor.';
        $this->_type = $seller && $sale ? 'success' : 'danger';
        $request->session()->flash('message', $this->_message);
        $request->session()->flash('type', $this->_type);

        // event(new SaleCreatedEvent($sale));
        if ($seller) {
            return redirect()->route('sale.index');
        }

        return redirect()->back()->withInput();
    }
}
