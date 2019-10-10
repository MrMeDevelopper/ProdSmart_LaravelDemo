<?php

namespace App\Http\Controllers;

use App\StockMovement;
use App\Item;
use App\BaseStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class StockMovementsController extends Controller
{

    //
    public function index(){

        $stockmovements = \App\StockMovement::all();
      //  return $projects; //para API's ja retornava em JSON
        return view('stockmovements',['stockmovements'=>$stockmovements]);
    }

    public function create(){

        $items = \App\Item::all();
   
        return view('stockmovements_create',['items'=>$items]);
      }

    public function edit($id){

        $stockmovement = StockMovement::findOrFail($id);
 
        return view('stockmovements_view',['stockmovement'=>$stockmovement]);
    }

    public function update($id){ ///projects/{{ project->id }}
    //dd(request()->all())

   
    
    $stockmovement = StockMovement::find($id);
    $oldQuantity = $stockmovement->quantity;
    $stockmovement->update([
      'quantity' => request('quantity')
    ]);

    $stockservice = app('App\StockService');
    $stockservice->updateStockMovement($stockmovement->item_id,$stockmovement->quantity,$oldQuantity);

    return redirect('/stockmovements');
  }

    public function store(){


      $arrayRequest = request();
      
      $validated = request()->validate([
        'quantity' => ['required','integer'],
        'item_id' => ['required']
      ]);
      StockMovement::create($validated);


      $arrayRequest = request();

      $stockservice = app('App\StockService');
      $stockservice->insertStockMovement($arrayRequest['item_id'],$arrayRequest['quantity']);
      $movementQuantity = $arrayRequest->quantity;
      $item_id = $arrayRequest->item_id;
     // $orders = DB::table('orders')->where('item_id', $item_id)->get();
      $orders = DB::table('orders')->where([
        ['item_id',$item_id],
        ['completed','0'],
    ])->get();
      
    $i =0;
        for($i=0;$i<sizeof($orders);$i++){
          $stockservice->executeOrder($orders[$i]->id,$orders[$i]->item_id,$orders[$i]->quantity);
        }

     
      //todo implementar validaçao para evitar client side hacking, id tem de ser verificado se existe na db

     

      return redirect('/stockmovements');
    }

    public function destroy($id){
        StockMovement::find($id)->delete();
        return redirect('/stockmovements');
    }
}
