<!-- Teacher Dashboard -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">
    <title>Teacher Dashboard</title>
</head>
<body>
<div class="container" style="margin-top:10px; padding: 10px;">
        <div class="row box-primary" style="padding: 10px;">
            <div class="col-md-4 col-md-offset-4 profile" >

            <div class="row" style="margin-top: 10px;">
                
                <div class="col-lg-9" style="display:flex; align-items: center;">
                <img src="{{asset($teacher->image)}}" style="width:120px; height:120px; border-radius: 50%; border: 2px solid black;" alt="">
     
                <header>{{$teacher->name}}</header>
                </div>

                <div class="col-lg-3" style="padding-left: 100px;">
                <a href="/logout-teacher">
                <button class="btn btn-danger">Logout</button>
                </a>
                </div>

            <hr>
            <header style="font-size: 25px; margin-bottom: 40px;">Your Information</header>
        <div class="row">
            <div class="col-lg-6">
            <p><b>Teacher Id:</b> T{{$teacher->id}}</p>
            <p><b>Teacher Name:</b> {{$teacher->name}}</p>
            <p><b>Teacher Email:</b> {{$teacher->email}}</p>
            <p><b>Teacher Address:</b> {{$teacher->address}}</p>
            </div>

<div class="col-lg-6">
            <p><b>Current School:</b> {{$teacher->cs}}</p>
            <p><b>Previous School:</b> {{$teacher->ps}}</p>
            <p><b>Teacher Experience:</b> {{$teacher->experience}}</p>
            <p><b>Teacher Expertise:</b> {{$teacher->expertise}}</p>
            </div>
            <hr>
            <div class="col-lg-12 d-flex justify-content-center align-items-center" style="margin-bottom: 10px;">
            <a href="{{route('teacher-edit')}}">
            <button class="btn btn-primary">Edit</button>
            </a>
            </div>
    </div>
</div>
</div>
</body>
</html>