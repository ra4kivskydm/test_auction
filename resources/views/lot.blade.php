@include('layouts.header')
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Name</th>
        <th>Description</th>
        <th>Categories</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tr>

    </tr>

    <tr>
            <td><p>{{$lot->name}}</p></td>
            <td>{{$lot->description}}</td>
            <td>
                @foreach ($lot->categories()->get() as $category)
                    <p>{{$category->name}}</p>
                @endforeach
            </td>
            <td>
                <a href="{{route('lot.edit', $lot->id)}}" class="btn btn-warning">Edit</a>
            </td>
            <td>
                <form action="{{route('lot.delete', $lot->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">delete</button>

                </form>


            </td>



    </tr>
</table>


@include('layouts.footer')
