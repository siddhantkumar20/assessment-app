<!-- Admin Registration Page -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">
    <title>Admin Registration Page</title>
</head>

<body>
<div class="container">
        <div class="row box-primary">
            <div class="col-md-4 col-md-offset-4 box1-admin-reg" style="margin-top:20px;">
            <div class="d-flex col-xs col-lg-4 col-sm-6 justify-content-center">
                <a href="/">
                <button class="btn btn-success">Go to Home</button>
                </a>
            </div>            
            <hr>
            <header>Admin Registration Page</header>
                <hr>
                <form action="{{route('register-admin')}}" method="post">
                    @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{old('name')}}">
                    </div>
                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                    
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{old('email')}}">
                    </div>
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    
                    <div class="form-group">
                        <label for="password">Set Password:</label>
                        <input type="password" class="form-control" placeholder="Set Password" name="password" value="">
                    </div>
                    <span class="text-danger">@error('password') {{$message}} @enderror</span>
                    
                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="submit">Register</button>
                    </div>
                </form>
                <h6>Registered Admin ?<a href="admin" class="regi"> Login Here</a></h6>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>