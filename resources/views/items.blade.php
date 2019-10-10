@extends("layouts.main")


@section("targetContent")
<div class="content">



    <table class="table">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Date created</th>
       
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
          
            
            <tr>
            <th scope="row">{{ $item->id }}</th>
            <td>{{ $item->name }}</td>
            <td>{{ $item->created_at }}</td>
            <td><a href="/items/edit/{{$item->id}}">Edit</a></td>

            </tr>
            @endforeach

            
        </tbody>
    </table>
    <a href="/items/create"><button type="submit" class="btn btn-primary">Add Item</button></a>
</div>

@endsection