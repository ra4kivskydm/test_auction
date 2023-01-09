@include('layouts.header')

<a href="{{route('category.index')}}" class="btn btn-outline-primary">Manage categories</a>
<form action="{{route('lot.filter')}}" method="post">
    @csrf
@foreach ($categories as $category )
    <label class="btn btn-secondary">{{$category->name}}<input type="checkbox" name="idcategory[]" value="{{$category->id}}" ></label>
    @endforeach
    <button type="submit" class="btn btn-success">Filter</button>

</form>
<a href="{{route('lot.create')}}" class="btn btn-outline-primary">Create new lot</a>


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
        @foreach ($lots as $lot)
            <td><a href="{{route('lot.show', $lot->id)}}">{{$lot->name}}</a></td>
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
    @endforeach
</table>

    @include('layouts.footer')
