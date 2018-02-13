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

  private $_uri = '';
  private $_locale = '';

  public function __constructor()
  {
    $this->_locale = \App::getLocale();

    $this->_uri = 'call_trackings';
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
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    )
    {
      $calls = Call::orderBy('id', 'desc')
                ->paginate(5);
    }
    else
    {
      $calls = Call::where('user_id', '=', $currentUser->id)
                ->orderBy('id', 'desc')
                ->paginate(5);
    }

    return view('calls.index', compact('calls', 'this->_uri'));
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
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    ) {
      $expedients = InternalExpedient::all()
                      ->sortBy('expedient');
      $clients = Client::all()
                  ->sortBy('last_name')
                  ->sortBy('first_name');
    } else {
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

    return view('calls.create', compact('created_at', 'this->_uri', 'states', 'expedients', 'clients'));
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
      'user_id' => \Auth::id(),
      'type_of_operation' => $request->type_of_operation,
      'internal_expedient_id' => $request->internal_expedient_id,
      'address' => $request->address,
      'state_id' => $request->state_id,
      'observations' => $request->observations,
      'status' => $request->status,
      'priority' => $request->priority,
    ];

    $updated = Call::create($call);

    $message = ($updated)
                 ? 'Nueva llamada creada'
                 : 'No se pudo crear la llamada.';

    $type = ($updated)
              ? 'success'
              : 'danger';

    if ( $request->ajax() )
    {
      return response()->json( [ 'message' => $message ] );
    }
    else
    {
      if ($updated)
      {
        return redirect('call_trackings')->with( 'message', $message )
                                         ->with( 'type', 'success' );
      }
      else
      {
        return redirect()->back()
                         ->with( 'message', $message )
                         ->with( 'type', 'success' );
      }
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Call  $call
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request)
  {
    $currentUser = User::with('role')->find(Auth::id());

    if (
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    ) {
      $call = Call::findOrFail($request->id);
    } else {
      Call::where('id', $request->id)
        ->where('user_id', Auth::id())
        ->get()
        ->first();
    }

    return view('calls.show', compact('call', 'this->_uri'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Call  $call
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request)
  {
    $states = State::all();

    $currentUser = User::find(Auth::id());

    if (
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    )
    {
      $expedients = InternalExpedient::all()
                      ->sortBy('expedient');
      $clients = Client::all()
                  ->sortBy('last_name')
                  ->sortBy('first_name');
      $call = Call::findOrFail($request->id);
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

    return view('calls.edit', compact('this->_uri', 'states', 'call', 'clients', 'expedients'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Call  $call
   * @return \Illuminate\Http\Response
   */
  public function update(CallRequest $request)
  {
    $currentUser = User::with('role')->find(Auth::id());

    $call = [
      'user_id' => $request->user_id,
      'type_of_operation' => $request->type_of_operation,
      'internal_expedient_id' => $request->expedient_id,
      'address' => $request->address,
      'state_id' => $request->state_id,
      'observations' => $request->observations,
      'status' => $request->status,
      'priority' => $request->priority,
    ];

    if (
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    )
    {
      $updated = Call::findOrFail($request->id)
                  ->update($call);
      \Debugbar::info($updated);
    }
    else
    {
      $updated = Call::where('id', $request->id)
                  ->where('user_id', Auth::id())
                  ->update($call);
    }

    $message = ($updated)
                  ? 'Llamada actualizada'
                  : 'No se pudo actualizar la llamada.';

    $type = ($updated)
              ? 'success'
              : 'danger';

    if ($request->ajax())
    {
      return response()->json( [ 'message' => $message ] );
    }
    else
    {
      if ($updated)
      {
        return redirect('call_trackings')->with( 'message', $message )
                                         ->with( 'type', 'success' );
      }
      else
      {
        return redirect()->back()
                         ->with( 'message', $message )
                         ->with( 'type', 'success' );
      }
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Call  $call
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $call = Call::findOrFail($request->id);
    $isDestroyed = $call->delete();

    $message = ($isDestroyed)
                  ? 'Llamada eliminada'
                  : 'No se pudo eliminar la llamada.';

    $type = ($isDestroyed)
              ? 'success'
              : 'danger';

    if ( $request->ajax() )
    {
      return response()->json( [ 'message' => $message ] );
    }
    else
    {
      return redirect(route('call_trackings'))
              ->with( 'message', $message )
              ->with( 'type', 'success' );
    }
  }

  public function filter(CallSearchRequest $request)
  {
    $currentUser = User::find(Auth::id());

    if (
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    ) {
      $calls = Call::whereBetween('created_at', [
                  $request->date, now()->tomorrow()
                ])
                ->orderBy('id', 'desc')
                ->paginate(5);
    } else {
      $calls = Call::whereBetween('created_at', [
                  $request->date, now()->tomorrow()
                ])
                ->where('user_id', '=', $currentUser->id)
                ->orderBy('id', 'desc')
                ->paginate(5);
    }

    $message = (count($calls) > 0)
                  ? count($calls).' Llamadas encontradas'
                  : 'No se pudo encontrar ninguna llamada.';

    $type = (count($calls) > 0) ? 'success' : 'danger';

    $request->session()->flash('date', $request->date);

    if ($request->ajax())
    {
      return response()->json([
        'calls' => $calls,
        'message' => $message,
        'type' => $type,
      ]);
    }
    else
    {
      return view('calls.filter')->with('calls', $calls)
                                 ->with('uri', $this->_uri)
                                 ->with('message', $message)
                                 ->with('type', $type);
    }
  }
}
