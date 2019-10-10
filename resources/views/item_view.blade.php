@extends("layouts.main")


@section("targetContent")
<div class="content">


<form method="POST" action="/items/edit/{{ $item->id }}">
{{ csrf_field() }}

{{ method_field('PATCH') }}

    <div class="form-group">
        <label for="exampleInputPassword1">Name</label>
        <input type="text" value="{{ $item->name }}" class="form-control" id="exampleInputPassword1" name="name" placeholder="Name here">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<form method="POST" action="/items/{{ $item->id }}">
        {{ csrf_field() }}

        {{ method_field('DELETE') }}
            <input style="margin-top:50px;" type="submit" value="Delete" class="btn btn-danger">
        </form>

</div>

@endsection