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
<div class="container" style="margin-top:10px">
        <div class="row box-primary">
            <div class="col-md-4 col-md-offset-4 box1-std-dash">
            <a href="/">
                <button class="btn btn-success">Go to Home</button>
                </a>
            <h2>Welcome {{$student->name}}</h2>
        
        <h3>Your Information</h3>

            <p>Student Id: Std{{$student->id}}</p>
            <p>Student Name: {{$student->name}}</p>
            <p>Student Email: {{$student->email}}</p>
            <p>Student Address: {{$student->address}}</p>
            <p>Current School: {{$student->cs}}</p>
            <p>Previous School: {{$student->ps}}</p>
            <p>Parent's Name: {{$student->parent}}</p>
            <p>Parent's Phone: {{$student->parentno}}</p>
            <p>Assigned Teacher: {{$student->teacher}}</p> 
 
            <a href="{{route('student-edit',['id'=>$student->id])}}">
                <button class="btn btn-primary">Edit</button>
            </a>

            </div>
        </div>
</div>
</div>
    </div>
</body>
</html>