@extends("layouts.main")

<?php
use App\Item;
use App\User;
?>
@section("targetContent")
<div class="content">



    <table class="table">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Ordered Quantity</th>
            <th scope="col">Quantity left to fill</th>
            <th scope="col">Date created</th>
            <th scope="col">Item</th>
            <th scope="col">Order Creator</th>
            <th scope="col">Order Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
          
            
            <tr>
            <th scope="row">{{ $order->id }}</th>
            <td>{{ $order->ordered_quantity }}</td>
            <td>{{ $order->quantity }}</td>
            <td>{{ $order->created_at }}</td>

            <?php  $item = Item::find($order->item_id); ?>
            <td><?php if(!$item){ echo "deleted"; }else{echo $item->name;}?></td>
            <?php  $user = User::find($order->user_id); ?>
            <td><?php if(!$user){ echo "deleted"; }else{echo $user->name;}?></td>
            <td><?php $orderstatus = $order->completed; if($orderstatus == 1){ echo "completed";}else{echo "waiting";} ?></td>
            <td><a href="/orders/edit/{{$order->id}}">Edit</a> | <a href="/orders/stockmovementsorder/{{$order->id}}">View History</a> </td>
            </tr>
            @endforeach

            
        </tbody>
    </table>
    <a href="/orders/create"><button type="submit" class="btn btn-primary">Add Order</button></a>
</div>

@endsection