<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

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
    //
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
  public function store(ClientRequest $request)
  {
    $data = $request->all();
    unset($data['_token']);

    $isRepeated = Client::where('email', $data['email']);

    if ($isRepeated) {
      return redirect()->back()
                       ->with('message', 'El cliente ya existe. El email ya se encuentra en la base de datos.')
                       ->with('type', 'warning');
    }

    $updated = Client::create($data);

    $message = ($updated)
               ? 'Nuevo cliente creado'
               : 'No se pudo agregar el cliente.';

    $type = ($updated)
            ? 'success'
            : 'danger';

    if ( $request->ajax() )
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

    $message = ($client)
                ? 'Nuevo cliente creado'
                : 'No se pudo agregar el cliente.';

    $type = ($client)
              ? 'success'
              : 'danger';

    if ($request->ajax())
    {
      return response()->json(['client', $client]);
    }
    else
    {
      return $client;
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
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Client $client)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Client  $client
   * @return \Illuminate\Http\Response
   */
  public function destroy(Client $client)
  {
      //
  }
}
