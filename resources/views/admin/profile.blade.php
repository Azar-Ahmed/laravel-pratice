@extends('admin.includes.layout')
@section('page_title', 'Admin Profile')
    @section('container')

        <div class="row justify-content-center my-5">
            <div class="col-md-6">
               
             <h1>Admin Profile</h1>
            
             <div class="card">
                <div class="card-body">
                    <p>Name : {{$admin->name}}</p>
                    <p>Name : {{$admin->email}}</p>

                    <br>
                    <a href="{{ route('admin.logout') }}" class="btn btn-danger"> Logout </a>
                </div>
             </div>



                

            </div>
        </div>

    @endsection
@section('custom_script')
    
@endsection