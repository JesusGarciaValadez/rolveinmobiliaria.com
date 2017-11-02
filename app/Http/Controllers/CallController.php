<?php

namespace App\Http\Controllers;

use App\Call;
use App\State;
use App\Client;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\CallRequest;
use App\Http\Requests\CallSearchRequest;
use Illuminate\Support\Facades\Gate;

class CallController extends Controller
{
  use ThrottlesLogins;

  public function __constructor()
  {
    //
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $locale = \App::getLocale();

    $uri = 'call_trackings';

    $calls = Call::orderBy('id', 'desc')->paginate(5);

    return view('call.index', compact('calls', 'uri'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $locale = \App::getLocale();

    $clients = Client::all()->sortBy('name');

    $uri = 'call_trackings';

    Carbon::setLocale($locale);
    $created_at = Carbon::now('America/Mexico_City')->toDateTimeString();

    $states = State::all();

    return view('call.create', compact('created_at', 'uri', 'states', 'clients'));
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

    $updated = Call::create($data);

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
    $locale = \App::getLocale();

    $uri = 'call_trackings';

    $call = Call::findOrFail($request->id);

    return view('call.show', compact('call', 'uri'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Call  $call
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request)
  {
    $locale = \App::getLocale();

    $uri = 'call_trackings';

    $states = State::all();

    $call = Call::findOrFail($request->id);

    return view('call.edit', compact('uri', 'states', 'call'));
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

    $updated = Call::findOrFail($request->id)
                   ->update($data);

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
    $call = Call::findOrFail($request->id);
    $destroyed = $call->delete();

    $message = ($destroyed) ? 'Llamada eliminada' : 'No se pudo eliminar la llamada.';
    $type = ($destroyed) ? 'success' : 'danger';

    if ( $request->ajax() )
    {
      return response()->json( [ 'message' => $message ] );
    }
    else
    {
      return redirect()->back()
                       ->with( 'message', $message )
                       ->with( 'type', 'success' );
    }
  }

  public function search(CallSearchRequest $request)
  {
    $calls = Call::whereBetween('created_at', [$request->date, now()->today()])
                 ->orderBy('id', 'desc')
                 ->paginate(5);

    $message = (count($calls) > 0) ? count($calls).' Llamadas encontradas' : 'No se pudo ninguna llamada.';
    $type = (count($calls) > 0) ? 'success' : 'danger';

    $locale = \App::getLocale();

    $uri = 'call_trackings';

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
      // \Debugbar::warning($session);
      return view('call.search')->with('calls', $calls)
                                ->with('uri', $uri)
                                ->with('message', $message)
                                ->with('type', $type);
    }
  }
}
