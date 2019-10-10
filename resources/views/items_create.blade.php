@extends("layouts.main")


@section("targetContent")
<div class="content">


<form method="POST" action="/items/create">
{{ csrf_field() }}


    <div class="form-group">
        <label for="exampleInputPassword1">Name</label>
        <input type="text" value="" class="form-control" id="exampleInputPassword1" name="name" placeholder="Name here">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection