<!-- Student Dashboard -->

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Admin {{$student->name}}</title>
</head>
<body>
    <div class="container">
        <h2>Welcome {{$student->name}}</h2>
        <h3>You Information</h3>
        <div class="row">
            <div class="col-md-4 col-md-offset-4" style="margin-top:20px;">

            <h3>Student Id: Std{{$student->id}}</h3>
            <h3>Student Name: {{$student->name}}</h3>
            <h3>Student Email: {{$student->email}}</h3>
            <h3>Student Address: {{$student->address}}</h3>
            <h3>Current School: {{$student->cs}}</h3>
            <h3>Previous School: {{$student->ps}}</h3>
            <h3>Parent's Name: {{$student->parent}}</h3>
            <h3>Parent's Phone: {{$student->parentno}}</h3>
            <h3>Assigned Teacher: {{$student->teacher}}</h3> 
 
            <a href="{{route('student-edit',['id'=>$student->id])}}">
                <button class="btn btn-primary">Edit</button>
            </a>

            </div>
        </div>

    </div>
</body>
</html>