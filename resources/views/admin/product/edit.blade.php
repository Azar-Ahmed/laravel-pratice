@extends('admin.includes.layout')
@section('page_title', 'Edit Product')
    @section('container')

        <div class="row justify-content-center my-5">
            <div class="col-md-12">
                <div class="d-flex">
                    <div class="p-2 flex-grow-1">
                        <h2>Edit Product</h2>
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
                        <form method="post" action="{{url('admin/product/'.$product->slug)}}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                              <label class="form-label">Name</label>
                              <input type="text" class="form-control" name="name" value="{{$product->name}}">
                              <span class="text-danger">@error('name'){{$message}} @enderror</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select  border-1" name="category_id">
                                    <option selected disabled>Select Category</option>
                                    
                                    @foreach ($category as $item)
                                        @if ($item->id == $product->category_id)
                                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }} </option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('category_id'){{$message}} @enderror</span>
                              </div>

                              <div class="mb-3">
                                <label class="form-label">Description</label>
                                <div class="form-floating">
                                    <textarea class="form-control" name="desc" placeholder="Product Description" id="floatingTextarea">{{$product->desc}}</textarea>
                                    <label for="floatingTextarea">Product Description</label>
                                  </div>
                                <span class="text-danger">@error('name'){{$message}} @enderror</span>
                              </div>

                              <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="price" value="{{$product->price}}">
                                <span class="text-danger">@error('price'){{$message}} @enderror</span>
                              </div>

                              <div class="mb-3">
                                <label class="form-label">Cover Image</label>
                                <input type='file' id="imageUpload" name="cover_image" class="form-control" accept=".png, .jpg, .jpeg" />
                                <span class="text-danger">@error('cover_image'){{$message}} @enderror</span>
                                <img class="form-control my-2" src="{{asset('uploads/product/'.$product->cover_image) }}" style="width: 150px; height:100px"  alt="edit">
                              </div>

                              <div class="mb-3">
                                <label class="form-label">Multiple Image</label>
                                <input type="file" class="form-control" name="image_url[]" accept="image/jpg, image/jpeg, image/png" multiple="multiple">
                                <span class="text-danger">@error('image_url'){{$message}} @enderror</span>
                                
                                <div class="row my-4">
                                    @foreach ($multiple_img as $img)
                                    <div class="col-md-3 text-center">
                                        <a href="{{ url('uploads/product/multiple_img/'.$img->image_url) }}" target="_blank" data-lightbox="image-1" data-title="Media Image">
                                         <img class="border border-primary" src="{{ url("uploads/product/multiple_img/".$img->image_url) }}" width="150px" height="150px"></a> <br>
                                         <button class="btn btn-outline-danger btn-sm my-3 delete_image " value="{{$img->id}}" title="Delete Image">Delete</button>   
                                     </div>
                                     @endforeach
                                 </div>
                            
                            </div>
                              
                            <button type="submit" class="btn btn-primary mt-3">Update Product</button>
                        </form>
                    </div>
                </div>

               
            </div>
        </div>

    @endsection
@section('custom_script')
<script>
    $(document).ready(function () {
        $('.delete_image').click(function (e) { 
            e.preventDefault();
            console.log($(this).val())

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: `{{ route('product.image_delete') }}`,
                data: {
                        image_id: $(this).val(),
                    },
                dataType: "JSON",
                success: function(response) {
                    if(response.Status === 200){
                        location.reload();
                    }
                }
            });
            
        });
    });
</script>
@endsection