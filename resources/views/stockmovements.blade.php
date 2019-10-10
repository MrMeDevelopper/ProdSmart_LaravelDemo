@extends("layouts.main")


@section("targetContent")
<?php
use App\Item;
?>
<div class="content">

<div  style="overflow-y: auto;height: 500px;">

    <table class="table">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Quantity</th>
            <th scope="col">Date</th>
            <th scope="col">Item</th>
            
            </tr>
        </thead>
        <tbody>
       
            @foreach ($stockmovements as $stockmovement)
          

            <tr>
            <th scope="row">{{ $stockmovement->id }}</th>
            <td>{{ $stockmovement->quantity }}</td>
            <td>{{ $stockmovement->created_at }}</td>
            <?php  $item = Item::find($stockmovement->item_id); ?>
            <td><?php if(!$item){ echo "deleted"; }else{echo $item->name;}?></td>
            <td><a href="/stockmovements/edit/{{$stockmovement->id}}">Edit</a></td>
            </tr>


          
            @endforeach
            
            
        </tbody>
    </table>
    </div>
    <a href="/stockmovements/create"><button type="submit" class="btn btn-primary">Add Stock Movement</button></a>
</div>

@endsection