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

<form class="form-inline" action="{{route('category.update', $category->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group mx-sm-3 mb-2">
      <input type="text" class="form-control" name="name"  value="{{$category->name}}" required>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Edit category</button>
  </form>

@include('layouts.footer')
