
<!-- Student's Approval list -->

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">
    <title>Welcome {{$admin->name}}</title>


</head>
<body>
<div class="container" style="margin-top: 10px;">
        <div class="row box-primary">
            <div class="col-md-4 col-md-offset-4 box1-approval-home" style="margin-top:20px;">
            <a href="/admin-dashboard/{{$admin->id}}">
            <button class="btn btn-primary">Home Dashboard</button>
        </a>
            <div>
                
<header>Student Approval List</header>
</div>    
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>View</th>
                </tr>
            </thead>

            <tbody>
            @foreach($approval as $approvalstudent)
                <tr>
                    <td>{{$approvalstudent->name}}</td>
                    <td>{{$approvalstudent->email}}</td>
                    <td>
                    <a href="{{route('view-student',['id' => $admin->id,'s_id'=> $approvalstudent->id])}}">
                        <button class="btn btn-primary">View</button>
                    </a>
</td>
                  
                </tr>
            
                @endforeach
            </tbody>
        </table>
        </div>
</div>
</div>
</body>
</html>














