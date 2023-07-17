@extends('admin.auth.layout')
@section('page_title', 'Login')
    @section('container')

        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Admin Login</h2>

                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show alert_message" role="alert">
                                {{ session('error') }}
                            </div>
                        @elseif(session('success'))
                            <div class="alert alert-success alert-dismissible fade show alert_message" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="post" action="{{route('admin.login_submit')}}">
                            @csrf
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Email address</label>
                              <input type="email" class="form-control" name="email" value="{{old('email')}}">
                              <span class="text-danger">@error('email'){{$message}} @enderror</span>
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Password</label>
                              <input type="password" class="form-control" name="password" value="{{old('password')}}">
                              <span class="text-danger">@error('password'){{$message}} @enderror</span>

                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
             

            </div>
        </div>

    @endsection
@section('custom_script')
    
@endsection