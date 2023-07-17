@extends('admin.includes.layout')
@section('page_title', 'Category')
    @section('container')

        <div class="row justify-content-center my-5">
            <div class="col-md-6">
               
             <h1>Category</h1>
            
             <div class="card">
                <div class="card-body">
                    <p>Name : {{$category->name}}</p>
                  
                    <br>
                </div>
             </div>



                

            </div>
        </div>

    @endsection
@section('custom_script')
    
@endsection