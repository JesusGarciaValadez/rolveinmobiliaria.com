<?php

namespace App\Http\Controllers;

use App\Sale;
use App\State;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SaleController extends Controller
{
  use ThrottlesLogins;

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $sales = Sale::orderBy('id', 'desc')->paginate(5);

    $locale = \App::getLocale();

    $uri = 'for_sales';

    return view('sale.index', compact('sales', 'uri'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $uri = 'for_sales';

    $states = State::all();

    return view('sale.create')->withUri($uri)
                              ->withStates($states);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $data = $request->all();
    $data['user_id'] = \Auth::id();
    unset($data['_token']);

    $updated = Sale::create($data);

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
        return redirect('for_sales')->with( 'message', $message )
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
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request)
  {
    $uri = 'for_sales';

    $sale = Sale::findOrFail($request->id);

    return view('sale.show', compact('uri', 'sale'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function edit(Sale $sale)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Sale $sale)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $sale = Sale::findOrFail($request->id);
    $destroyed = $sale->delete();

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
}
