@extends("layouts.main")


@section("targetContent")
<?php
use App\Item;
?>
<div class="content">



    <table class="table">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Quantity</th>
            <th scope="col">Item</th>
            </tr>
        </thead>
        <tbody>
       
            @foreach ($basestocks as $basestock)
          

            <tr>
            <th scope="row">{{ $basestock->id }}</th>
            <td>{{ $basestock->quantity }}</td>
            <?php  $item = Item::find($basestock->item_id); ?>
            <td><?php if(!$item){ echo "deleted"; }else{echo $item->name;}?></td>

            </tr>


          
            @endforeach
            
            
        </tbody>
    </table>
    <a href="/stockmovements/create"><button type="submit" class="btn btn-primary">Add Stock Movement</button></a>
</div>

@endsection