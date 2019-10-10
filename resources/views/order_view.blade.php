@extends("layouts.main")


@section("targetContent")
<div class="content">


<form method="POST" action="/orders/edit/{{ $order->id }}">
{{ csrf_field() }}

{{ method_field('PATCH') }}

    <div class="form-group">
        <label for="exampleInputPassword1">Quantity</label>
        <input type="text" value="{{ $order->quantity }}" class="form-control" id="exampleInputPassword1" name="quantity" placeholder="ammount here">
    </div>

    <button type="submit" class="btn btn-primary">Submit Order</button>
</form>

<form method="POST" action="/orders/{{ $order->id }}">
        {{ csrf_field() }}

        {{ method_field('DELETE') }}
            <input style="margin-top:50px;" type="submit" value="Delete" class="btn btn-danger">
        </form>

</div>

@endsection