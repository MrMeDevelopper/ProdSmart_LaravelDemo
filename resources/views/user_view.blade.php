@extends("layouts.main")


@section("targetContent")
<div class="content">


<form method="POST" action="/users/edit/{{ $user->id }}">
{{ csrf_field() }}

{{ method_field('PATCH') }}
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Name</label>
        <input type="text" value="{{ $user->name }}" class="form-control" id="exampleInputPassword1" name="name" placeholder="Name here">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<form method="POST" action="/users/{{ $user->id }}">
        {{ csrf_field() }}

        {{ method_field('DELETE') }}
            <input style="margin-top:50px;" type="submit" value="Delete" class="btn btn-danger">
        </form>

</div>

@endsection