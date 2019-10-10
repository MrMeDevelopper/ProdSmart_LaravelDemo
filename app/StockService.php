<?php

namespace App;
use App\StockMovement;
use App\Item;
use App\BaseStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockService{

public function __constructor(){

}


public function isStockAvailable($item_id){
    $stocksitem = DB::table('base_stocks')->where('item_id', $item_id)->first();

    if(!$stocksitem){
        return false;
    }

    if($stocksitem->quantity <= 0){
        return false;
    }


    return true;
}

public function executeOrder($order_id,$item_id,$quantity){

        //todo- implementar rollbacks no caso de uma das queries falhar 
        //todo- security checks ..
       //verificar se existe stock

     $order_inserted_id = $order_id;


       $stockAv = $this->getStockForItemId($item_id);
       if($stockAv > 0 && $quantity > 0){
           $ammountToTake = 0;
           $quantityNeed = $quantity;
   
   
           if($quantityNeed >= $stockAv){
               $ammountToTake = $stockAv;
           }else if($quantityNeed < $stockAv){
   
               $ammountToTake = $quantityNeed;
           }
   
           $difference = $quantityNeed - $stockAv;
           $howManyMore = $difference;
           $orderFilled = false;
   
           if($difference <= 0){
               $orderFilled = true;
             $howManyMore = 0;
           }else{
               $orderFilled = false;
            
           }
         
           //criar um stock movement
           $stockmovement = new StockMovement();
           $stockmovement->item_id = $item_id;
           $stockmovement->quantity = $ammountToTake*-1;
           $stockmovement->save();
           $inserted_stock_mov = $stockmovement->id;
           //atualizar o stock
           $res = $this->insertStockMovement($item_id,  $ammountToTake * -1);
   
           //logar no historico
           $stockmovementorder = new StockMovementOrder();
           $stockmovementorder->stock_movement_id = $inserted_stock_mov;
           $stockmovementorder->order_id = $order_inserted_id;
           $stockmovementorder->save();
   
           //atualizar a ordem
           $res = DB::table('orders')
           ->where('id', $order_inserted_id)
           ->update(['quantity' => $howManyMore,'completed' => $orderFilled]);
       }
}

public function getStockForItemId($item_id){
  $stocksitem = DB::table('base_stocks')->where('item_id', $item_id)->first();

  if(!$stocksitem){
      return 0;
  }



  return $stocksitem->quantity;

}

//movement item id and quantity
public function updateStockMovement($item_id, $quantity,$oldquantity){
    $this->insertStockMovement($item_id, $quantity, false, $oldquantity);
  }

  //movement item id and quantity
  public function insertStockMovement($item_id, $quantity, $isInsert = true,$old_movement_quantity = 0){


    /*
    se o item_id nao existir entao vai ser insert senao vai ser update
    */

    $will_update = true;
    //$item = BaseStock::find($item_id);

    $stocksitem = DB::table('base_stocks')->where('item_id', $item_id)->first();
   

    if(!$stocksitem){
        $will_update = false;
    }
   
    if(!$will_update){
     
     
        $basestock = new BaseStock();
        $basestock->quantity = $quantity;
        $basestock->item_id = $item_id;
        $res = $basestock->save();

    }else{


     
      $current_quantity = $stocksitem->quantity;
      $new_quantity = 0;
      if($isInsert){
        $new_quantity = $current_quantity + $quantity;
      }else{
      
       $new_quantity = 0;

       $difference = 0;
       $subtract = false;
       $sum = false;
       if($old_movement_quantity > $quantity){
        $difference = $old_movement_quantity - $quantity;
        $subtract = true;
       }else if($old_movement_quantity < $quantity){
         $difference = $quantity - $old_movement_quantity;
         $sum = true;
       }else{
         $new_quantity = $current_quantity;
       }

       if($sum){
        $new_quantity = $current_quantity + $difference;
       }

       if($subtract){
        $new_quantity = $current_quantity - $difference;
       }
      

      }
      


       $res = DB::table('base_stocks')
            ->where('item_id', $item_id)
            ->update(['quantity' => $new_quantity]);

        
        
       
    }
    return $res;

}



}