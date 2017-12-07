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
      $calls = Call::with([
                    'internal_expedient',
                    'state',
                    'user',
                    'client'
                  ])
                  ->orderBy('id', 'desc')
                  ->paginate(5);
    }
    else
    {
      $calls = Call::with([
                    'internal_expedient',
                    'state',
                    'user',
                    'client'
                  ])
                  ->where('user_id', '=', $currentUser->id)
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
    $data = $request->all();
    $data['user_id'] = \Auth::id();
    unset($data['_token']);

    $expedient = [
      'client_id' => $data['client_id'],
      'expedient' => $data['expedient'],
    ];

    $expedientStored = InternalExpedient::create($expedient);

    $call = [
      'user_id' => $data['user_id'],
      'type_of_operation' => $data['type_of_operation'],
      'expedient_id' => $expedientStored->id,
      'client_id' => $data['client_id'],
      'address' => $data['address'],
      'observations' => $data['observations'],
      'status' => $data['status'],
      'priority' => $data['priority']
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
      $call = Call::with(['internal_expedient', 'state', 'user', 'client'])
                  ->findOrFail($request->id);
    } else {
      Call::with(['internal_expedient', 'state', 'user', 'client'])
           ->where('id', $request->id)
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

    $currentUser = User::with('role')
                       ->find(Auth::id());

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
      $call = Call::with([
                'internal_expedient',
                'state',
                'user',
                'client'
              ])
              ->findOrFail($request->id);
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
      $call = Call::with(['internal_expedient', 'state', 'user',  'client'])
                  ->where('id', $request->id)
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
    $data = $request->all();
    unset($data['_token']);

    $currentUser = User::with('role')->find(Auth::id());

    $expedient = [
      'id'  => $data['expedient_id'],
      'client_id' => $data['client_id'],
      'expedient' => $data['expedient'],
    ];

    $updated = Call::create($call);

    $expedientStored = InternalExpedient::find($expedient['id'])
                                        ->update($expedient);

    $call = [
      'user_id' => $data['user_id'],
      'type_of_operation' => $data['type_of_operation'],
      'expedient_id' => $expedientStored->id,
      'client_id' => $data['client_id'],
      'address' => $data['address'],
      'observations' => $data['observations'],
      'status' => $data['status'],
      'priority' => $data['priority']
    ];

    if (
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    )
    {
      $updated = Call::with(['internal_expedient', 'state', 'user', 'client'])
                     ->findOrFail($request->id)
                     ->update($call);
    }
    else
    {
      $call = Call::with(['internal_expedient', 'state', 'user', 'client'])
                  ->where('id', $request->id)
                  ->where('user_id', Auth::id())
                  ->get()
                  ->first()
                  ->update($call);
    }

    $message = ($updated)
                  ? 'Llamada actualizada'
                  : 'No se pudo actualizar la llamada.';

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
   * Remove the specified resource from storage.
   *
   * @param  \App\Call  $call
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $call = Call::with(['internal_expedient', 'state', 'user', 'client'])
                ->findOrFail($request->id);
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

  public function search(CallSearchRequest $request)
  {
    $currentUser = User::with('role')
                       ->find(Auth::id());

    if (
      $currentUser->hasRole('Super Administrador') ||
      $currentUser->hasRole('Administrador')
    ) {
      $calls = Call::with(['internal_expedient', 'state', 'user', 'client'])
                   ->whereBetween('created_at', [
                    $request->date, now()->tomorrow()
                   ])
                   ->orderBy('id', 'desc')
                   ->paginate(5);
    } else {
      $calls = Call::with(['internal_expedient', 'state', 'user', 'client'])
                   ->whereBetween('created_at', [
                     $request->date, now()->tomorrow()
                   ])
                   ->where('user_id', '=', $currentUser->id)
                   ->orderBy('id', 'desc')
                   ->paginate(5);
    }

    $message = (count($calls) > 0)
                  ? count($calls).' Llamadas encontradas'
                  : 'No se pudo ninguna llamada.';

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
      return view('calls.search')->with('calls', $calls)
                                 ->with('uri', $this->_uri)
                                 ->with('message', $message)
                                 ->with('type', $type);
    }
  }
}
