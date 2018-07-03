<?php

namespace App\Http\Controllers;

use App\SaleNotary;
use App\Sale;
use Illuminate\Http\Request;

class SaleNotaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function index(Sale $sale)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function create(Sale $sale)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @param  \App\SaleNotary  $saleNotary
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale, SaleNotary $saleNotary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @param  \App\SaleNotary  $saleNotary
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale, SaleNotary $saleNotary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @param  \App\SaleNotary  $saleNotary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale, SaleNotary $saleNotary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @param  \App\SaleNotary  $saleNotary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale, SaleNotary $saleNotary)
    {
        //
    }
}
