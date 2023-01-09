@include('layouts.header')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="form-inline" action="{{route('category.store')}}" method="post">
    @csrf
    <div class="form-group mx-sm-3 mb-2">
      <input type="text" class="form-control" name="name" id="" placeholder="Category name" required>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Create category</button>
  </form>


        <table class="table">
             <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            @foreach ($categories as $category)
            <tr>
                <th><a href="{{route('category.show', $category->id)}}">{{$category->name}}</a></th>
                <th><a href="{{route('category.edit', $category->id)}}">Edit</a></th>
                <th>
                    <form action="{{route('category.destroy', $category->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </th>
            </tr>
            @endforeach
        </table>

        @include('layouts.footer')
