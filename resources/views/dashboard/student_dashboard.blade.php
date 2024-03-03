<!-- Student Dashboard -->

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">
    <title>{{$student->name}}</title>
</head>
<body>
<div class="container" style="margin-top:10px; padding: 10px;">
        <div class="row box-primary" style="padding: 10px;">
            <div class="col-md-4 col-md-offset-4 profile" >

                <div class="row" style="margin-top: 10px;">
                
                <div class="col-lg-9" style="display:flex; align-items: center;">
                <img src="{{asset($student->image)}}" style="width:120px; height:120px; border-radius: 50%; border: 2px solid black; margin-right: 10px;" alt="">  

                <header>{{$student->name}}</header>
                </div>

                <div class="col-lg-3" style="padding-left: 100px;">
            <a href="/logout-student">
                <button class="btn btn-danger">Logout</button>
                </a>
                
                </div>
            </div>    
            <hr>
            
        
            <header style="font-size: 25px; margin-bottom: 40px;">Your Information</header>
        <div class="row">
            <div class="col-lg-6">
            <p><b>Student Id:</b> Std {{$student->id}}</p>
            <p><b>Student Name:</b> {{$student->name}}</p>
            <p><b>Student Email:</b> {{$student->email}}</p>
            <p><b>Student Address:</b> {{$student->address}}</p>
            </div>

            <div class="col-lg-6">
            <p><b>Current School:</b> {{$student->cs}}</p>
            <p><b>Previous School:</b> {{$student->ps}}</p>
            <p><b>Parent's Name:</b> {{$student->parent}}</p>
            <p><b>Parent's Phone:</b> {{$student->parentno}}</p>
            <p><b>Assigned Teacher:</b>{{$student->teacher}}</p> 
            </div>
            <hr>
            <div class="col-lg-12 d-flex justify-content-center align-items-center" style="margin-bottom: 10px;">
            <a href="{{route('student-edit')}}">
                <button class="btn btn-primary">Edit</button>
            </a>
            </div>
            </div>

            
            </div>
        </div>
</div>
</div>
</div>
</body>
</html>