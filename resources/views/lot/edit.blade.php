@include('layouts.header')
<br>
<form action="{{route('lot.update', $lot->id)}}" method="post">
    @method('PUT')
    @csrf
    <div class="form-group row">
      <label for="inputName" class="col-sm-2 col-form-label">Name</label>
      <div class="col-sm-10">
        <input class="form-control" id="inputName" placeholder="Name" type="text" name="name" value="{{$lot->name}}"  required>
      </div>
    </div>
    <div class="form-group row">
      <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
      <div class="col-sm-10">
        <textarea class="form-control" rows="6" id="inputDescription" placeholder="Description" type="text" name="description" required>{{$lot->description}}</textarea>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-2">Categories</div>
      <div class="col-sm-10">
        <div class="form-check">
            @foreach ($categories as $category )
            <label class="btn btn-secondary">{{$category->name}}
            <input type="checkbox" name="idcategory[]" value="{{$category->id}}"
            @if (in_array($category->id, $lotCategoryIdsArray))
                checked
                @endif
                >
            </label>
            @endforeach
        </div>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </div>
  </form>
