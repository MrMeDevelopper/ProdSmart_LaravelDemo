@extends("layouts.main")


@section("targetContent")
<div class="content">


<form method="POST" action="/orders/create">
{{ csrf_field() }}


    <div class="form-group">
        <label for="exampleInputPassword1">Quantity</label>
        <input type="text" value="" class="form-control" id="exampleInputPassword1" name="quantity" placeholder="quantity here">
    </div>




    <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Item</label>
  </div>
  <select name="item_id" class="custom-select" id="inputGroupSelect01">
    <option value="" selected>Choose...</option>


    @foreach ($items as $item)
          
    <option value="{{ $item->id }}">{{ $item->name }}</option>

    @endforeach
  </select>

</div>
    <button type="submit" class="btn btn-primary">Submit Order</button>
</form>

@endsection