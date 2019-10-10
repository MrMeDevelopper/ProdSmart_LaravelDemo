<?php

namespace App\Http\Controllers;

use App\StockMovementOrder;
use App\Order;
use Illuminate\Http\Request;


class StockMovementOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
            $order = Order::findOrFail($id);
            //  return $projects; //para API's ja retornava em JSON
              return view('stockmovementsorder',['order'=>$order]);
              //return view('order_view',['order'=>$order]);
          
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
     * @param  \App\StockMovementOrder  $stockMovementOrder
     * @return \Illuminate\Http\Response
     */
    public function show(StockMovementOrder $stockMovementOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StockMovementOrder  $stockMovementOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(StockMovementOrder $stockMovementOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StockMovementOrder  $stockMovementOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockMovementOrder $stockMovementOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StockMovementOrder  $stockMovementOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockMovementOrder $stockMovementOrder)
    {
        //
    }
}
