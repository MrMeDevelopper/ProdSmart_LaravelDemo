@extends("layouts.main")


@section("targetContent")

<?php
use App\Item;
use App\StockMovement;
use Illuminate\Support\Facades\DB;
?>
<div class="content">


<h1>Movement history for the current order</h1>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Date</th>
            <th scope="col">Stock Moved Ammount</th>
            </tr>
        </thead>
        <tbody>
       <?php
       
 $movements = DB::table('stock_movement_orders')->where('order_id', $order->id)->get();
 ?>
       
            @foreach ($movements as $movement)
          

            <tr>
            <th scope="row">{{ $movement->id }}</th>
            <th scope="row">{{ $movement->created_at }}</th>
            <?php 
              $stockmovement = StockMovement::find($movement->stock_movement_id); 
            ?>
            <th scope="row"><?php if($stockmovement){ ?> {{ $stockmovement->quantity }} <?php }else{ ?> removed <?php } ?></th>
            </tr>


          
            @endforeach
            
            
        </tbody>
    </table>
    
</div>

@endsection