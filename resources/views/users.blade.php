@extends("layouts.main")


@section("targetContent")
<div class="content">



    <table class="table">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Registration Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
          

            <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            <td><a href="/users/edit/{{$user->id}}">Edit</a></td>
            </tr>
            @endforeach

   
        </tbody>
    </table>
</div>

@endsection