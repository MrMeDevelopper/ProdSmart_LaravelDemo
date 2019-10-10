@extends("layouts.main")


@section("targetContent")
<div class="content">


<form method="POST" action="/stockmovements/edit/{{ $stockmovement->id }}">
{{ csrf_field() }}

{{ method_field('PATCH') }}

    <div class="form-group">
        <label for="exampleInputPassword1">Quantity</label>
        <input type="text" value="{{ $stockmovement->quantity }}" class="form-control" id="exampleInputPassword1" name="quantity" placeholder="stock quantity">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<form method="POST" action="/stockmovements/{{ $stockmovement->id }}">
        {{ csrf_field() }}

        {{ method_field('DELETE') }}
            <input style="margin-top:50px;" type="submit" value="Delete" class="btn btn-danger">
        </form>

</div>

@endsection