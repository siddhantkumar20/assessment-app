
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">
    <title>Student</title>
</head>
<body>
<div class="container">
        <div class="row box-primary">
            <div class="col-md-4 col-md-offset-4 box1-admin-login">
            <img src="{{asset($approvalstudent->image)}}" style="width:120px; height:120px; border-radius: 50%; border: 2px solid black;" alt="">        
            <header  style="margin-top: 10px; margin-bottom:10px;">{{$approvalstudent->name}}</header>
        <p><b>Email:</b> {{$approvalstudent->email}}</p>
        <p><b>Address:</b> {{$approvalstudent->address}}</p>
        <p><b>Current School:</b> {{$approvalstudent->cs}}</p>
        <p><b>Previous School:</b> {{$approvalstudent->ps}}</p>
        <p><b>Parent:</b> {{$approvalstudent->parent}}</p>
        <p><b>Parent No.:</b> {{$approvalstudent->parentno}}</p>

            <div class="d-flex justify-content-center align-items-center">
                <div style="margin-right: 10px;">  
                    <form action="{{route('approve-student',['id'=>$approvalstudent->id])}}" method="post">
                    @csrf
                    <div class="d-flex justify-content-center align-items-center" style="margin-bottom: 10px;">
                    <label for="id"><b>Select Teacher:</b></label>
                    <select name="id">
                    @foreach($approval as $teacher)
                    <option value="{{ $teacher->id}}">
                    {{ $teacher->name }}
                    </option>
                    @endforeach
                    </select>
                    </div>
                    <div class="d-flex justify-content-center align-items-center" style="margin-bottom: 10px;">
                    <button type="submit" class="btn btn-warning">Approve</button>
                    </div>        
                </form>
                        </div>
                    </div>
                    
                    <div>
                    <form action="{{route('reject-student',['id'=>$approvalstudent->id])}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                    </div>
</div>
</div>
</body>
</html>


