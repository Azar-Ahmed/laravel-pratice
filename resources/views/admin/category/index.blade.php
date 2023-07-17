@extends('admin.includes.layout')
@section('page_title', 'Category')
    @section('container')

        <div class="row justify-content-center my-5">
            <div class="col-md-12">
                <div class="d-flex">
                    <div class="p-2 flex-grow-1">
                        <h2>Categories List</h2>
                    </div>
                    <div class="p-2">
                        <a href="{{url('admin/category/create')}}" class="btn btn-primary">Create Category</a>
                    </div>
                </div>
                

                <div>
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show alert_message" role="alert">
                        {{ session('error') }}
                    </div>
           
    
                @elseif(session('success'))
              
                    <div class="alert alert-success alert-dismissible fade show alert_message" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                </div>

                <hr class="mt-0">

                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($category as $item)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ date('d M Y', strtotime($item->created_at)) }}</td>
                                 <td>
                                    <form action="/admin/category/{{$item->slug}}" method="POST">
                                        @method('DELETE')
                                        @csrf 
                                        <a href="/admin/category/{{$item->slug}}" class="btn btn-info">View</a>
                                        <a href="/admin/category/{{$item->slug}}/edit" class="btn btn-success">Edit</a>
                                        <button type="submit" class="btn btn-danger" onclick="return checkDelete()">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                  </table>
                  <div>
                    {{$category->links()}}
                  </div>
            </div>
        </div>

    @endsection
@section('custom_script')
    
@endsection