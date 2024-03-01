<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">
    <title>Teacher Updation Page</title>
   
</head>
<body>

<div class="container">
        <div class="row box-primary">
            <div class="col-md-4 col-md-offset-4 box1" style="margin-top:20px;">
                  
            <hr>
            <header>Teacher Updation Page</header>
                <hr>
                <form action="{{route('update-teacher',['id'=>$teacher->id])}}" method="post" enctype="multipart/form-data">
                    @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{$teacher->name}}">
                    </div>
                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                    
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" placeholder="Enter address" name="address" value="{{$teacher->address}}">
                    </div>
                    <span class="text-danger">@error('address') {{$message}} @enderror</span>

                    <div class="form-group">
                        <label for="cs">Current School:</label>
                        <input type="text" class="form-control" placeholder="Enter Current School" name="cs" value="{{$teacher->cs}}">
                    </div>
                    <span class="text-danger">@error('cs') {{$message}} @enderror</span>

                    <div class="form-group">
                        <label for="ps">Previous School:</label>
                        <input type="text" class="form-control" placeholder="Enter Previous School" name="ps" value="{{$teacher->ps}}">
                    </div>
                    <span class="text-danger">@error('ps') {{$message}} @enderror</span>

                    <div class="form-group">
                        <label for="experience">Experience:</label>
                        <input type="text" class="form-control" placeholder="Experience" name="experience" value="{{$teacher->experience}}">
                    </div>
                    <span class="text-danger">@error('experience') {{$message}} @enderror</span>

                    <div class="form-group">
                        <label for="expertise">Expertise:</label>
                        <input type="text" class="form-control" placeholder="Enter Expertise" name="expertise" value="{{$teacher->expertise}}">
                    </div>
                    <span class="text-danger">@error('expertise') {{$message}} @enderror</span>

                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="submit">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>