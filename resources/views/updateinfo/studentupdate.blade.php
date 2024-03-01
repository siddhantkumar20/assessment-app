
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Student Updation Page</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">
</head>
<body>
<div class="container">
        <div class="row box-primary">
            <div class="col-md-4 col-md-offset-4 box1" style="margin-top:20px;">            
            <hr>
            <header>Student Updation Page</header>

                <hr>
                <form action="{{route('update-student',['id'=>$student->id])}}" method="post"  enctype="multipart/form-data">
                    @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif

                    @csrf   
                    
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{$student->name}}">
                    </div>
                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                    
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" placeholder="Enter address" name="address" value="{{$student->address}}">
                    </div>
                    <span class="text-danger">@error('address') {{$message}} @enderror</span>
                                        
                    <div class="form-group">
                        <label for="cs">Current School:</label>
                        <input type="text" class="form-control" placeholder="Enter Current School" name="cs" value="{{$student->cs}}">
                    </div>
                    <span class="text-danger">@error('cs') {{$message}} @enderror</span>
                    
                    <div class="form-group">
                        <label for="ps">Previous School:</label>
                        <input type="text" class="form-control" placeholder="Enter Previous School" name="ps" value="{{$student->ps}}">
                    </div>
                    <span class="text-danger">@error('ps') {{$message}} @enderror</span>

                    <div class="form-group">
                        <label for="parent">Parent Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Parent" name="parent" value="{{$student->parent}}">
                    </div>
                    <span class="text-danger">@error('parent') {{$message}} @enderror</span>
                    
                    <div class="form-group">
                        <label for="parentno">Parent Number:</label>
                        <input type="text" class="form-control" placeholder="Enter Parent Number" name="parentno" value="{{$student->parentno}}">
                    </div>
                    <span class="text-danger">@error('parentno') {{$message}} @enderror</span>
                    
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