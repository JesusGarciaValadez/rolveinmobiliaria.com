<?php

namespace App\Http\Controllers;

use App\SaleLog;
use App\Sale;
use Illuminate\Http\Request;

class SaleLogController extends Controller
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
     * @param  \App\SaleLog  $saleLog
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale, SaleLog $saleLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @param  \App\SaleLog  $saleLog
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale, SaleLog $saleLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @param  \App\SaleLog  $saleLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale, SaleLog $saleLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @param  \App\SaleLog  $saleLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale, SaleLog $saleLog)
    {
        //
    }
}
