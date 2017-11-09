<?php

namespace App\Http\Controllers;

use App\Client;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\ClientRequest;

class ClientController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $locale = \App::getLocale();

    $uri = 'clients';

    $clients = Client::orderBy('name', 'asc')->paginate(5);

    return view('clients.index', compact('clients', 'uri'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $locale = \App::getLocale();

    $clients = Client::with('internalExpedient')->get()->sortBy('name');

    $uri = 'clients';

    return view('clients.create', compact('uri', 'clients'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ClientRequest $request)
  {
    $data = $request->all();
    unset($data['_token']);

    $isRepeated = Client::where('email', $data['email'])->get()->count();

    if ($isRepeated !== 0) {
      return redirect()->back()
                       ->with('message', 'El cliente ya existe. El email ya se encuentra en la base de datos.')
                       ->with('type', 'warning');
    }

    $data['name'] = ucwords(strtolower($data['name']));

    $updated = Client::create($data);

    $message = ($updated)
               ? 'Nuevo cliente creado'
               : 'No se pudo agregar el cliente.';

    $type = ($updated)
            ? 'success'
            : 'danger';

    if ($request->ajax())
    {
      return response()->json(['message' => $message]);
    }
    else
    {
      return redirect()->back()
                       ->with('message', $message)
                       ->with('type', 'success');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request)
  {
    $client = Client::findOrFail($request->id);

    if ($request->ajax())
    {
      return response()->json(['client', $client]);
    }
    else
    {
      return view('clients.show', compact('client'));
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request)
  {
    $locale = \App::getLocale();

    $uri = 'clients';

    $client = Client::findOrFail($request->id);

    return view('clients.edit', compact('client'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function update(ClientRequest $request)
  {
    $data = $request->all();
    unset($data['_token']);
    $data['name'] = ucwords(strtolower($data['name']));

    $updated = Client::findOrFail($request->id)
                ->update($data);

    $message = ($updated)
               ? 'Cliente actualizado'
               : 'No se pudo actualizar la información del cliente.';

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
        return redirect('clients')->with( 'message', $message )
                                  ->with( 'type', $type );
      }
      else
      {
        return redirect()->back()
                         ->with( 'message', $message )
                         ->with( 'type', $type );
      }
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $client = Client::findOrFail($request->id);
    $isDestroyed = $client->delete();

    $message = ($isDestroyed) ? 'Cliente eliminado' : 'No se pudo eliminar al cliente.';
    $type = ($isDestroyed) ? 'success' : 'danger';

    if ( $request->ajax() )
    {
      return response()->json( [ 'message' => $message ] );
    }
    else
    {
      return redirect(route('clients'))
              ->with( 'message', $message )
              ->with( 'type', 'success' );
    }
  }
}
