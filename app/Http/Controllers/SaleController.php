<?php

namespace App\Http\Controllers;

use App\Sale;
use App\State;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    $uri = 'for_sale';

    return view('sale.index', compact('sales', 'uri'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $uri = 'for_sale';

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
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Sale  $sale
   * @return \Illuminate\Http\Response
   */
  public function show(Sale $sale)
  {
      //
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
  public function destroy(Sale $sale)
  {
      //
  }
}
