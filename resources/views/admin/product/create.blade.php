@extends('admin.includes.layout')
@section('page_title', 'Create Product')
    @section('container')

        <div class="row justify-content-center my-5">
            <div class="col-md-12">
                <div class="d-flex">
                    <div class="p-2 flex-grow-1">
                        <h2>Create Product</h2>
                    </div>
                    <div class="p-2">
                        <a href="{{url('admin/product')}}" class="btn btn-primary">Product List</a>
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
                        <form method="post" action="{{url('admin/product')}}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="mb-3">
                              <label class="form-label">Name</label>
                              <input type="text" class="form-control" name="name" value="{{old('name')}}">
                              <span class="text-danger">@error('name'){{$message}} @enderror</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select  border-1" name="category_id">
                                    <option selected disabled>Select Category</option>
                                    @foreach ($category as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('category_id'){{$message}} @enderror</span>
                              </div>

                              <div class="mb-3">
                                <label class="form-label">Description</label>
                                <div class="form-floating">
                                    <textarea class="form-control" name="desc" placeholder="Product Description" id="floatingTextarea">{{old('desc')}}</textarea>
                                    <label for="floatingTextarea">Product Description</label>
                                  </div>
                                <span class="text-danger">@error('name'){{$message}} @enderror</span>
                              </div>

                              <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="price" value="{{old('price')}}">
                                <span class="text-danger">@error('price'){{$message}} @enderror</span>
                              </div>

                              <div class="mb-3">
                                <label class="form-label">Cover Image</label>
                                <input type='file' id="imageUpload" name="cover_image" class="form-control" accept=".png, .jpg, .jpeg"  value="{{old('cover_image')}}"/>
                                <span class="text-danger">@error('cover_image'){{$message}} @enderror</span>
                              </div>

                              <div class="mb-3">
                                <label class="form-label">Multiple Image</label>
                                <input type="file" class="form-control" name="image_url[]" accept="image/jpg, image/jpeg, image/png" multiple="multiple">
                                <span class="text-danger">@error('image_url'){{$message}} @enderror</span>
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