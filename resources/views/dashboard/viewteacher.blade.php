<!-- Teacher's Approval list -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">
    <title>Teacher</title>

</head>

<body>
<div class="container">
        <div class="row box-primary">

     
<div class="col-md-4 col-md-offset-4 box1-admin-login">
        
        <header>Name: {{$approval->name}}</header>
        <p>Email: {{$approval->email}}</p>
        <p>Address: {{$approval->address}}</p>
        <p>Current School: {{$approval->cs}}</p>
        <p>Previous School: {{$approval->ps}}</p>
        <p>Experience: {{$approval->experience}}</p>
        <p>Expertise: {{$approval->expertise}}</p>


  <div class="d-flex">
    <div style="margin-right: 10px;">
                    <form action="{{route('approve-teacher',['id'=>$approval->id])}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-warning">Approve</button>
                    </form>
                    </div>
                    
                    <div>
                    <form action="{{route('reject-teacher',['id'=>$approval->id])}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                    </div>
                    </div>
    
</div>
</div>
</div>
</body>
</html>