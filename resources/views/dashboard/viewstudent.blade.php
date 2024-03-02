
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
        
            <header>Name: {{$approvalstudent->name}}</header>
        <p>Email: {{$approvalstudent->email}}</p>
        <p>Address: {{$approvalstudent->address}}</p>
        <p>Current School: {{$approvalstudent->cs}}</p>
        <p>Previous School: {{$approvalstudent->ps}}</p>
        <p>Parent: {{$approvalstudent->parent}}</p>
        <p>Parent No.: {{$approvalstudent->parentno}}</p>

            <div class="d-flex">
    <div style="margin-right: 10px;">
                    <form action="{{route('approve-student',['id'=>$approvalstudent->id])}}" method="post">
                    @csrf
                    <select name="id">
                    @foreach($approval as $teacher)
                    <option value="{{ $teacher->id}}">
                    {{ $teacher->name }}
                    </option>
                    @endforeach
                    </select>
                    
                    <button type="submit" class="btn btn-warning">Approve</button>
     
               </form>
               </div>
               <div>
                    <form action="{{route('reject-student',['id'=>$approvalstudent->id])}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                    </div>
                    </div>
</tbody>
</table>

</div>
</div>
</body>
</html>


