@extends('admin.includes.layout')
@section('page_title', 'Edit Category')
    @section('container')

        <div class="row justify-content-center my-5">
            <div class="col-md-12">
                <div class="d-flex">
                    <div class="p-2 flex-grow-1">
                        <h2>Edit Category</h2>
                    </div>
                    <div class="p-2">
                        <a href="{{url('admin/category')}}" class="btn btn-primary">Category List</a>
                    </div>
                </div>

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show alert_message" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                <hr class="mt-0">
                
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{url('admin/category/'.$category->slug)}}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                              <label class="form-label">Name</label>
                              <input type="text" class="form-control" name="name" value="{{$category->name}}">
                              <span class="text-danger">@error('name'){{$message}} @enderror</span>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

               
            </div>
        </div>

    @endsection
@section('custom_script')
    
@endsection