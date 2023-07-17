@extends('admin.includes.layout')
@section('page_title', 'Product')
    @section('container')

        <div class="row justify-content-center my-5">
            <div class="col-md-12">
                <div class="d-flex">
                    <div class="p-2 flex-grow-1">
                        <h2>Products List</h2>
                    </div>
                    <div class="p-2">
                        <a href="{{url('admin/product/create')}}" class="btn btn-primary">Create Product</a>
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
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($product as $item)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->cat_name }}</td>
                                <td>{{ $item->price }}</td>
                                <td><img  src="{{asset('uploads/product/'.$item->cover_image) }}" style="width: 100px; height:100px" alt="Product Image" /></td>
                                <td>{{ date('d M Y', strtotime($item->created_at)) }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <a href="{{ url('admin/product/inactive/'.$item->slug) }}" class="btn btn-success btn-circle btn-sm" title="Active">Active</a>
                                    @elseif ($item->status == 0)
                                        <a href="{{ url('admin/product/active/'.$item->slug) }}" class="btn btn-danger btn-circle btn-sm" title="Inactive">Inactive</a>
                                    @endif
                                </td>  
                                 <td>
                                    <form action="/admin/product/{{$item->slug}}" method="POST">
                                        @method('DELETE')
                                        @csrf 
                                        <a href="/admin/product/{{$item->slug}}" class="btn btn-info">View</a>
                                        <a href="/admin/product/{{$item->slug}}/edit" class="btn btn-success">Edit</a>
                                        <button type="submit" class="btn btn-danger" onclick="return checkDelete()">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                  </table>
            </div>
        </div>

    @endsection
@section('custom_script')
    
@endsection