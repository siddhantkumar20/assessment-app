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
<div class="container" style="margin-top:10px">
        <div class="row box-primary">
            <div class="col-md-4 col-md-offset-4 box1-std-dash">
            <a href="/logout-teacher">
                <button class="btn btn-success">Logout</button>
                </a>
            <h2>Welcome {{$teacher->name}}</h2>
        
        <header>Your Information</header>

            <p>Teacher Id: T{{$teacher->id}}</p>
            <p>Teacher Name: {{$teacher->name}}</p>
            <p>Teacher Email: {{$teacher->email}}</p>
            <p>Teacher Address: {{$teacher->address}}</p>
            <p>Current School: {{$teacher->cs}}</p>
            <p>Previous School: {{$teacher->ps}}</p>
            <p>Teacher Experience: {{$teacher->experience}}</p>
            <p>Teacher Expertise: {{$teacher->expertise}}</p>

        <a href="{{route('teacher-edit')}}">
            <button class="btn btn-primary">Edit</button>
        </a>
    </div>
</div>
</div>
</body>
</html>