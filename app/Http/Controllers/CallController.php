<?php

namespace App\Http\Controllers;

use App\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
  public function __constructor()
  {
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $calls = Call::paginate(10);
    $uri = \Route::current()->uri;

    return view('call.index', compact('calls', 'uri'));
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
  public function store(Request $request)
  {
      //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Call  $call
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Call  $call
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request)
  {
    return 'Editar llamada: '.$request->id;
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Call  $call
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $call = Call::findOrFail($request->id);
    $destroyed = $call->delete();

    $message = ($destroyed)
               ? 'Llamada actualizada'
               : 'No se pudo actualizar la llamada.';

    $type = ($destroyed)
            ? 'success'
            : 'danger';

    if ( $request->ajax() )
    {
      return response()->json( [ 'message' => $message ] );
    }
    else
    {
      return \Redirect()->back()
                        ->with( 'message', $message )
                        ->with( 'type', 'success' );
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
      return \Redirect()->back()
                        ->with( 'message', $message )
                        ->with( 'type', 'success' );
    }
  }
}
