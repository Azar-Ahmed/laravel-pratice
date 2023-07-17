@extends('admin.includes.layout')
@section('page_title', 'Product')
    @section('container')

        <div class="row justify-content-center my-5">
            <div class="col-md-8">
               
             <h1>Product</h1>
             <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <p>Name : {{$product->name}}</p>
                            <p>Category : {{$product->cat_name}}</p>
                            <p>Price : {{$product->price}}</p>
                            <p>Description : {{$product->desc}}</p>
                            <p>Status : 
                                @if ($product->status == 1)
                                    <span class="text-success">Active</span>
                                @else
                                    <span class="text-danger">Inactive</span>
                                @endif
                            </p>

                        </div>
                        <div class="col-md-6">
                           <div>
                               <img  src="{{asset('uploads/product/'.$product->cover_image) }}" style="width: 200px; height:200px" alt="Product Image" />
                           </div>
                        </div>
                     </div>
                     <hr>
                     <div class="row my-4">
                         @foreach ($multiple_img as $img)
                         <div class="col-md-3 text-center">
                             <a href="{{ url('uploads/product/multiple_img/'.$img->image_url) }}" target="_blank" data-lightbox="image-1" data-title="Media Image">
                              <img class="border border-primary" src="{{ url("uploads/product/multiple_img/".$img->image_url) }}" width="150px" height="150px"></a> <br>
                          </div>
                          @endforeach
                      </div>
                   </div>
             </div>



                

            </div>
        </div>

    @endsection
@section('custom_script')
    
@endsection