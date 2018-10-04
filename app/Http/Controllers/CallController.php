<?php

namespace App\Http\Controllers;

use App\User;
use App\Call;
use App\State;
use App\Client;
use App\InternalExpedient;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Http\Requests\CallRequest;
use App\Http\Requests\CallSearchRequest;

class CallController extends Controller
{
  use ThrottlesLogins;

  /**
   * Set the uri returned to views.
   *
   * @var string
   */
  private $_uri = 'call';

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
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $currentUser = User::with('role')->find(Auth::id());

    if (
      $currentUser->hasRole(\App\Enums\RoleType::SUPER_ADMIN) ||
      $currentUser->hasRole(\App\Enums\RoleType::ADMIN)
    )
    {
      $calls = Call::orderBy('id', 'desc')
                ->get();
    }
    else
    {
      $calls = Call::where('user_id', '=', $currentUser->id)
                ->orderBy('id', 'desc')
                ->get();
    }

    return view('calls.index', [
      'calls' => $calls,
      'uri'   => $this->_uri,
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
    )
    {
      $expedients = InternalExpedient::all()
                      ->sortBy('expedient');
      $clients = Client::all()
                  ->sortBy('last_name')
                  ->sortBy('first_name');
    }
    else
    {
      $expedients = InternalExpedient::where('user_id', Auth::id())
                      ->get()
                      ->sortBy('expedient');
      $clients = Client::where('user_id', Auth::id())
                  ->get()
                  ->sortBy('last_name')
                  ->sortBy('first_name');
    }

    Carbon::setLocale($this->_locale);
    $created_at = Carbon::now('America/Mexico_City')->toDateTimeString();

    $states = State::all();

    return view('calls.create', [
      'created_at'  => $created_at,
      'states'      => $states,
      'expedients'  => $expedients,
      'clients'     => $clients,
      'uri'         => $this->_uri,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CallRequest $request)
  {
    $call = [
      'user_id'               => \Auth::id(),
      'type_of_operation'     => $request->type_of_operation,
      'internal_expedient_id' => $request->internal_expedient_id,
      'address'               => $request->address,
      'state_id'              => $request->state_id,
      'observations'          => $request->observations,
      'status'                => $request->status,
      'priority'              => $request->priority,
    ];

    $updated = Call::create($call);

    $this->_message = ($updated)
      ? 'Nueva llamada creada'
      : 'No se pudo crear la llamada.';
    $this->_type = ($updated) ? 'success' : 'danger';
    $request->session()->flash('message', $this->_message);
    $request->session()->flash('type', $this->_type);

    if ($updated)
    {
      return redirect()->route('call.index');
    }
    else
    {
      return redirect()->back()->withInput();
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Call  $call
   * @return \Illuminate\Http\Response
   */
  public function show(Call $call, Request $request)
  {
    $request->session()->flush();

    $currentUser = User::with('role')->find(Auth::id());

    return view('calls.show', [
      'call'  => $call,
      'uri'   => $this->_uri,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Call  $call
   * @return \Illuminate\Http\Response
   */
  public function edit(Call $call, Request $request)
  {
    $states = State::all();

    $currentUser = User::find(Auth::id());

    if (
      $currentUser->hasRole(\App\Enums\RoleType::SUPER_ADMIN) ||
      $currentUser->hasRole(\App\Enums\RoleType::ADMIN)
    )
    {
      $expedients = InternalExpedient::all()
                      ->sortBy('expedient');
      $clients = Client::all()
                  ->sortBy('last_name')
                  ->sortBy('first_name');
      $call = $call;
    }
    else
    {
      $expedients = InternalExpedient::where('user_id', Auth::id())
                      ->get()
                      ->sortBy('expedient');
      $clients = Client::where('user_id', Auth::id())
                  ->get()
                  ->sortBy('last_name')
                  ->sortBy('first_name');
      $call = Call::where('id', $request->id)
                  ->where('user_id', Auth::id())
                  ->get()
                  ->first();
    }

    return view('calls.edit', [
      'states'      => $states,
      'call'        => $call,
      'clients'     => $clients,
      'expedients'  => $expedients,
      'uri'         => $this->_uri,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Call  $call
   * @return \Illuminate\Http\Response
   */
  public function update(CallRequest $request, Call $call)
  {
    $currentUser = User::with('role')->find(Auth::id());

    $callInfo = [
      'user_id'               => $request->user_id,
      'type_of_operation'     => $request->type_of_operation,
      'internal_expedient_id' => $request->internal_expedient_id,
      'address'               => $request->address,
      'state_id'              => $request->state_id,
      'observations'          => $request->observations,
      'status'                => $request->status,
      'priority'              => $request->priority,
    ];

    if (
      $currentUser->hasRole(\App\Enums\RoleType::SUPER_ADMIN) ||
      $currentUser->hasRole(\App\Enums\RoleType::ADMIN)
    )
    {
      $updated = $call->update($callInfo);
    }
    else
    {
      $updated = Call::where('id', $request->id)
                  ->where('user_id', Auth::id())
                  ->update($call);
    }

    $this->_message = ($updated)
      ? 'Llamada actualizada'
      : 'No se pudo actualizar la llamada.';
    $this->_type = ($updated) ? 'success' : 'danger';
    $request->session()->flash('message', $this->_message);
    $request->session()->flash('type', $this->_type);

    if ($updated)
    {
      return redirect()->route('call.index');
    }
    else
    {
      return redirect()->back()->withInput();
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Call  $call
   * @return \Illuminate\Http\Response
   */
  public function destroy(Call $call, Request $request)
  {
    $isDestroyed = $call->delete();

    $this->_message = ($isDestroyed)
      ? 'Llamada eliminada'
      : 'No se pudo eliminar la llamada.';
    $this->_type = ($isDestroyed) ? 'success' : 'danger';
    $request->session()->flash('message', $this->_message);
    $request->session()->flash('type', $this->_type);

    if ($isDestroyed)
    {
      return redirect()->route('call.index');
    }
    else
    {
      return redirect()->back()->withInput();
    }
  }

  public function filter(CallSearchRequest $request)
  {
    $currentUser = User::find(Auth::id());

    if (
      $currentUser->hasRole(\App\Enums\RoleType::SUPER_ADMIN) ||
      $currentUser->hasRole(\App\Enums\RoleType::ADMIN)
    )
    {
      $calls = Call::whereBetween('created_at', [
                  $request->date, now()->tomorrow()
                ])
                ->orderBy('id', 'desc')
                ->get();
    }
    else
    {
      $calls = Call::whereBetween('created_at', [
                  $request->date, now()->tomorrow()
                ])
                ->where('user_id', '=', $currentUser->id)
                ->orderBy('id', 'desc')
                ->get();
    }

    $this->_message = (count($calls) > 0)
      ? count($calls).' llamadas encontradas'
      : 'No se pudo encontrar ninguna llamada.';
    $this->_type = (count($calls) > 0) ? 'success' : 'danger';
    $request->session()->flash('date', $request->date);
    $request->session()->flash('message', $this->_message);
    $request->session()->flash('type', $this->_type);

    return view('calls.filter', [
      'calls'   => $calls,
      'uri'     => $this->_uri,
    ]);
  }
}
