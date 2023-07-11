<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register Ecommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <style>
        a {
          text-decoration: none;
        }
        </style>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Register</h2>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('admin.register_submit')}}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                <span class="text-danger">@error('name'){{$message}} @enderror</span>
                              </div>
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
                            <button type="submit" class="btn btn-primary">Submit</button>

                            <div class="text-center my-4">
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
                        </form>
                        <p>Already Registerd? <a href="{{route('admin.login')}}">Login</a></p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
  
</body>
</html>