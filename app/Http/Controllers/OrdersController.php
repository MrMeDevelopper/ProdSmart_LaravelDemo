<?php

namespace App\Http\Controllers;

use App\Order;

use App\StockMovement;
use App\StockMovementOrder;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
     //
     public function index(){
        //passar os items para mostra numa combo
        $orders = \App\Order::all();
      //  return $projects; //para API's ja retornava em JSON
        return view('orders',['orders'=>$orders]);
    }

    public function create(){
       
        $items = \App\Item::all();
   
        return view('orders_create',['items'=>$items]);
      }

    public function edit($id){

        $order = Order::findOrFail($id);
 
        return view('order_view',['order'=>$order]);
    }

    public function update($id){ ///projects/{{ project->id }}
    //dd(request()->all())

    $order = Order::find($id);


    $order_status = $order->completed;
    
    if($order->completed == 1 && request('quantity') > 0){
        $order_status = 0;
    }

    $order->update([
      'quantity' => request('quantity'),
      'ordered_quantity' => request('quantity'),
      'completed' => $order_status
    ]);

    $order_id = $order->id;
    $item_id = $order->item_id;
    $quantity = request('quantity');

    $stockservice = app('App\StockService');
    $stockservice->executeOrder($order_id,$item_id,$quantity);


    return redirect('/orders');
  }



    public function store(){

        $arrayRequest = request();
     
        $user = auth()->user();

        $arrayRequest['user_id'] = $user->id;
        $arrayRequest['completed'] = 0;
        $arrayRequest['ordered_quantity'] = $arrayRequest->quantity;
       
      $validated = $arrayRequest->validate([
        'quantity' => ['required','min:1','integer','gte:0'],
        'item_id' => ['required'],
        'user_id' => ['required'],
        'ordered_quantity' => ['required']
      ]);

    
    //return null;
      $res = Order::create($validated);

      //so chega a esta linha se foi valido e enviado
      $order_inserted_id = $res->id;
    $item_id = $arrayRequest->item_id;
    $quantity = $arrayRequest->quantity;

    $stockservice = app('App\StockService');
    $stockservice->executeOrder($order_inserted_id,$item_id,$quantity);
/*
      //verificar se existe stock

     $stockservice = app('App\StockService');


    $stockAv = $stockservice->getStockForItemId($item_id);
    if($stockAv > 0 && $quantity > 0){
        $ammountToTake = 0;
        $quantityNeed = $quantity;


        if($quantityNeed >= $stockAv){
            $ammountToTake = $stockAv;
        }else if($quantityNeed < $stockAv){

            $ammountToTake = $quantityNeed;
        }

        $difference = $quantityNeed - $stockAv;

        $orderFilled = false;

        if($difference <= 0){
            $orderFilled = true;
          
        }else{
            $orderFilled = false;
         
        }
      
        //criar um stock movement
        $stockmovement = new StockMovement();
        $stockmovement->item_id = $item_id;
        $stockmovement->quantity = $ammountToTake;
        $stockmovement->save();
        $inserted_stock_mov = $stockmovement->id;
        //atualizar o stock
        $res = $stockservice->insertStockMovement($item_id,  $ammountToTake * -1);

        //logar no historico
        $stockmovementorder = new StockMovementOrder();
        $stockmovementorder->stock_movement_id = $inserted_stock_mov;
        $stockmovementorder->order_id = $order_inserted_id;
        $stockmovementorder->save();

        //atualizar a ordem
        $res = DB::table('orders')
        ->where('id', $order_inserted_id)
        ->update(['quantity' => $stockAv,'completed' => $orderFilled]);
    }
*/


      return redirect('/orders');
    }

    public function destroy($id){
        Order::find($id)->delete();
        return redirect('/orders');
    }
}
