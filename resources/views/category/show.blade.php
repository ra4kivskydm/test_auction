@include('layouts.header')

<table class="table">
    <thead class="thead-dark">
   <tr>
       <th>Name</th>
       <th>Edit</th>
       <th>Delete</th>
   </tr>
   </thead>

   <tr>
       <th><p>{{$category->name}}</p></th>
       <th><a href="{{route('category.edit', $category->id)}}">Edit</a></th>
       <th>
           <form action="{{route('category.destroy', $category->id)}}" method="post">
               @csrf
               @method('DELETE')
               <button type="submit">Delete</button>
           </form>
       </th>
   </tr>

</table>


@include('layouts.footer')

