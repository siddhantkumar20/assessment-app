<!-- Teacher's View Page -->

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
        
<img src="{{asset($approval->image)}}" style="width:120px; height:120px; border-radius: 50%; border: 2px solid black;" alt="">
        <header style="margin-top: 10px; margin-bottom:10px;">{{$approval->name}}</header>
        <p><b>Email:</b> {{$approval->email}}</p>
        <p><b>Address:</b> {{$approval->address}}</p>
        <p><b>Current School:</b> {{$approval->cs}}</p>
        <p><b>Previous School:</b> {{$approval->ps}}</p>  
        <p><b>Experience:</b> {{$approval->experience}}</p>
        <p><b>Expertise:</b> {{$approval->expertise}}</p>

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